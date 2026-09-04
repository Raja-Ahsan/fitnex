<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Trainer;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;

class WellnessProfessionalMatcher
{
    /**
     * @param  array<string, mixed>  $filters
     * @return array{trainers: LengthAwarePaginator, total: int, categories: \Illuminate\Support\Collection}
     */
    public function search(array $filters): array
    {
        $categories = Category::query()
            ->where('status', 1)
            ->whereIn('slug', $filters['services'] ?? [])
            ->get(['id', 'title', 'slug']);

        $query = Trainer::query()
            ->with('user')
            ->where('status', 1);

        $this->applyServiceFilter($query, $categories);
        $this->applyDeliveryFilter($query, (string) ($filters['delivery'] ?? ''));
        $this->applyLocationFilter($query, $filters);
        $this->applyGoalFilter($query, $filters['goals'] ?? []);

        $perPage = 12;
        $page = max(1, (int) ($filters['page'] ?? 1));
        $trainers = $query->orderByDesc('id')->paginate($perPage, ['*'], 'page', $page);

        $allCategories = Category::query()
            ->where('status', 1)
            ->get(['title', 'slug'])
            ->keyBy('slug');

        return [
            'trainers' => $trainers,
            'total' => $trainers->total(),
            'categories' => $allCategories,
        ];
    }

    /**
     * @param  \Illuminate\Support\Collection<int, Category>  $categories
     */
    protected function applyServiceFilter(Builder $query, $categories): void
    {
        if ($categories->isEmpty()) {
            $query->whereRaw('1 = 0');

            return;
        }

        $query->where(function (Builder $q) use ($categories) {
            foreach ($categories as $category) {
                $q->orWhere(function (Builder $inner) use ($category) {
                    $inner->where('trainer_type', $category->title)
                        ->orWhere('trainer_type', $category->slug)
                        ->orWhereRaw('FIND_IN_SET(?, trainer_type) > 0', [$category->slug]);
                });
            }
        });
    }

    protected function applyDeliveryFilter(Builder $query, string $delivery): void
    {
        if ($delivery === 'online' || $delivery === 'in_person') {
            $query->matchingDelivery($delivery);
        }
    }

    /**
     * @param  array<string, mixed>  $filters
     */
    protected function applyLocationFilter(Builder $query, array $filters): void
    {
        $delivery = (string) ($filters['delivery'] ?? '');
        if ($delivery === 'online') {
            return;
        }

        $city = trim((string) ($filters['city'] ?? ''));
        $state = trim((string) ($filters['state'] ?? ''));
        $zip = trim((string) ($filters['zip'] ?? ''));
        $radius = (int) ($filters['radius'] ?? 25);

        if ($city === '' && $state === '' && $zip === '') {
            return;
        }

        $stateTerms = $this->stateMatchTerms($state);
        $cityLike = $city !== '' ? $this->containsLike($city) : null;

        $query->where(function (Builder $q) use ($cityLike, $stateTerms, $zip, $radius) {
            if ($zip !== '') {
                $q->orWhere('zip_code', $zip);
            }

            $q->orWhere(function (Builder $geo) use ($cityLike, $stateTerms, $radius) {
                $tight = $radius > 0 && $radius < 25;

                if ($tight) {
                    if ($cityLike) {
                        $geo->where('city', 'like', $cityLike);
                    }
                    if ($stateTerms !== []) {
                        $geo->where(function (Builder $stateQ) use ($stateTerms) {
                            foreach ($stateTerms as $term) {
                                $stateQ->orWhere('state', 'like', $this->containsLike($term));
                            }
                        });
                    }
                } else {
                    $geo->where(function (Builder $loose) use ($cityLike, $stateTerms) {
                        if ($cityLike) {
                            $loose->orWhere('city', 'like', $cityLike);
                        }
                        if ($stateTerms !== []) {
                            $loose->orWhere(function (Builder $stateQ) use ($stateTerms) {
                                foreach ($stateTerms as $term) {
                                    $stateQ->orWhere('state', 'like', $this->containsLike($term));
                                }
                            });
                        }
                    });
                }
            });
        });
    }

    /**
     * @param  array<int, string>  $goalKeys
     */
    protected function applyGoalFilter(Builder $query, array $goalKeys): void
    {
        $options = config('wellness_goals.options', []);
        $keywords = [];

        foreach ($goalKeys as $key) {
            if ($key === 'other') {
                continue;
            }
            foreach ($options[$key]['keywords'] ?? [] as $keyword) {
                $keyword = strtolower(trim((string) $keyword));
                if ($keyword !== '') {
                    $keywords[] = $keyword;
                }
            }
        }

        $keywords = array_values(array_unique($keywords));

        // "Other" alone (or only Other) = no extra goal constraint.
        if ($keywords === []) {
            return;
        }

        $query->where(function (Builder $q) use ($keywords, $goalKeys, $options) {
            foreach ($keywords as $keyword) {
                $like = $this->containsLike($keyword);
                $q->orWhere('specialization', 'like', $like)
                    ->orWhere('trainer_type', 'like', $like)
                    ->orWhere('description', 'like', $like);
            }

            foreach ($goalKeys as $key) {
                foreach ($options[$key]['category_slugs'] ?? [] as $slug) {
                    $q->orWhere('trainer_type', $slug)
                        ->orWhereRaw('FIND_IN_SET(?, trainer_type) > 0', [$slug]);
                }
            }
        });
    }

    protected function containsLike(string $value): string
    {
        $escaped = str_replace(['\\', '%', '_'], ['\\\\', '\\%', '\\_'], $value);

        return '%'.$escaped.'%';
    }

    /**
     * @return array<int, string>
     */
    protected function stateMatchTerms(string $state): array
    {
        $state = trim($state);
        if ($state === '') {
            return [];
        }

        $terms = [$state];
        $normalized = strtoupper(preg_replace('/[^A-Za-z]/', '', $state) ?? '');
        $map = $this->usStateAliases();

        if (isset($map[$normalized])) {
            $terms[] = $map[$normalized];
        }

        $byName = array_flip($map);
        $nameKey = strtoupper($state);
        if (isset($byName[$nameKey])) {
            $terms[] = $byName[$nameKey];
        }

        // Title-case name lookup (e.g. "Florida" → FL)
        foreach ($map as $abbr => $name) {
            if (strcasecmp($name, $state) === 0) {
                $terms[] = $abbr;
            }
        }

        return array_values(array_unique(array_filter($terms)));
    }

    /**
     * @return array<string, string>
     */
    protected function usStateAliases(): array
    {
        return [
            'AL' => 'Alabama', 'AK' => 'Alaska', 'AZ' => 'Arizona', 'AR' => 'Arkansas',
            'CA' => 'California', 'CO' => 'Colorado', 'CT' => 'Connecticut', 'DE' => 'Delaware',
            'FL' => 'Florida', 'GA' => 'Georgia', 'HI' => 'Hawaii', 'ID' => 'Idaho',
            'IL' => 'Illinois', 'IN' => 'Indiana', 'IA' => 'Iowa', 'KS' => 'Kansas',
            'KY' => 'Kentucky', 'LA' => 'Louisiana', 'ME' => 'Maine', 'MD' => 'Maryland',
            'MA' => 'Massachusetts', 'MI' => 'Michigan', 'MN' => 'Minnesota', 'MS' => 'Mississippi',
            'MO' => 'Missouri', 'MT' => 'Montana', 'NE' => 'Nebraska', 'NV' => 'Nevada',
            'NH' => 'New Hampshire', 'NJ' => 'New Jersey', 'NM' => 'New Mexico', 'NY' => 'New York',
            'NC' => 'North Carolina', 'ND' => 'North Dakota', 'OH' => 'Ohio', 'OK' => 'Oklahoma',
            'OR' => 'Oregon', 'PA' => 'Pennsylvania', 'RI' => 'Rhode Island', 'SC' => 'South Carolina',
            'SD' => 'South Dakota', 'TN' => 'Tennessee', 'TX' => 'Texas', 'UT' => 'Utah',
            'VT' => 'Vermont', 'VA' => 'Virginia', 'WA' => 'Washington', 'WV' => 'West Virginia',
            'WI' => 'Wisconsin', 'WY' => 'Wyoming', 'DC' => 'District of Columbia',
        ];
    }
}
