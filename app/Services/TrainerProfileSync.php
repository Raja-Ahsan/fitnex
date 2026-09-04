<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Trainer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class TrainerProfileSync
{
    public static function registrationRules(): array
    {
        return [
            'trainer_category' => [
                'required',
                'string',
                Rule::exists('categories', 'slug')->where(fn ($q) => $q->where('status', 1)),
            ],
            'delivery' => 'required|in:online,in_person,both',
            'workplace' => 'nullable|string|max:255',
            'gym_name' => 'nullable|string|max:255',
        ];
    }

    public static function createFromRegistration(User $user, Request $request): Trainer
    {
        $deliveryModes = $request->delivery === 'both'
            ? 'online,in_person'
            : (string) $request->delivery;

        $categoryId = self::categoryIdFromSlug((string) $request->trainer_category);
        $trainer = self::resolveTrainer($user);

        return DB::transaction(function () use ($user, $request, $deliveryModes, $categoryId, $trainer) {
            $trainer->update([
                'trainer_type' => (string) $request->trainer_category,
                'delivery_modes' => $deliveryModes,
                'workplace' => $request->filled('workplace') ? trim((string) $request->workplace) : null,
                'gym_name' => $request->filled('gym_name') ? trim((string) $request->gym_name) : null,
                'status' => $user->status == 1 ? 1 : 0,
            ]);

            User::withoutEvents(function () use ($user, $categoryId) {
                if ($categoryId) {
                    $user->category_id = $categoryId;
                    $user->save();
                }
            });

            self::pruneDuplicateTrainerRows($user->id, $trainer->id);

            return $trainer->fresh();
        });
    }

    public static function categoryIdFromSlug(?string $slug): ?int
    {
        if (!$slug) {
            return null;
        }

        $category = Category::query()
            ->where('status', 1)
            ->where(function ($query) use ($slug) {
                $query->where('slug', $slug)->orWhere('title', $slug);
            })
            ->first();

        return $category?->id;
    }

    /**
     * Primary category for users.category_id (first valid slug).
     *
     * @param  array<int, string>  $slugs
     */
    public static function categoryIdFromSlugs(array $slugs): ?int
    {
        foreach ($slugs as $slug) {
            $id = self::categoryIdFromSlug($slug);
            if ($id) {
                return $id;
            }
        }

        return null;
    }

    /**
     * One trainer row per user (created_by). Prefer the row that already has profile data.
     */
    public static function resolveTrainer(User $user): Trainer
    {
        $trainers = Trainer::withTrashed()
            ->where('created_by', $user->id)
            ->orderByDesc('id')
            ->get();

        if ($trainers->isEmpty()) {
            return Trainer::create([
                'created_by' => $user->id,
                'status' => $user->status == 1 ? 1 : 0,
            ]);
        }

        $trainer = $trainers->sortByDesc(fn (Trainer $t) => self::trainerDataScore($t))->first();

        if ($trainer->trashed()) {
            $trainer->restore();
        }

        self::pruneDuplicateTrainerRows($user->id, $trainer->id);

        return $trainer->fresh();
    }

    /**
     * Category slugs for multi-select (handles legacy title-only values in trainer_type).
     *
     * @return array<int, string>
     */
    public static function trainerTypeSlugs(Trainer $trainer): array
    {
        $raw = trim((string) ($trainer->getAttributes()['trainer_type'] ?? ''));
        if ($raw === '') {
            return [];
        }

        $slugs = [];
        foreach (array_filter(array_map('trim', explode(',', $raw))) as $part) {
            $category = Category::query()
                ->where('status', 1)
                ->where(function ($query) use ($part) {
                    $query->where('slug', $part)->orWhere('title', $part);
                })
                ->first();
            $slugs[] = $category ? $category->slug : $part;
        }

        return array_values(array_unique($slugs));
    }

    protected static function trainerDataScore(Trainer $trainer): int
    {
        $attrs = $trainer->getAttributes();
        $score = 0;
        foreach (['trainer_type', 'description', 'price', 'city', 'state', 'zip_code', 'delivery_modes', 'workplace', 'gym_name'] as $column) {
            if (!empty($attrs[$column])) {
                $score++;
            }
        }

        return $score;
    }

    protected static function pruneDuplicateTrainerRows(int $userId, int $keepTrainerId): void
    {
        $keeper = Trainer::find($keepTrainerId);
        if (!$keeper) {
            return;
        }

        Trainer::withTrashed()
            ->where('created_by', $userId)
            ->where('id', '!=', $keepTrainerId)
            ->get()
            ->each(function (Trainer $duplicate) use ($keeper) {
                $merge = [];
                foreach (['trainer_type', 'description', 'price', 'city', 'state', 'zip_code', 'delivery_modes', 'specialization', 'workplace', 'gym_name'] as $column) {
                    $keeperValue = $keeper->getAttributes()[$column] ?? null;
                    $duplicateValue = $duplicate->getAttributes()[$column] ?? null;
                    if (empty($keeperValue) && !empty($duplicateValue)) {
                        $merge[$column] = $duplicateValue;
                    }
                }
                if ($merge !== []) {
                    $keeper->update($merge);
                    $keeper->refresh();
                }
                $duplicate->forceDelete();
            });
    }

    public static function validationRules(User $user, bool $requireImage = false): array
    {
        $imageRule = ($requireImage ? 'required|' : 'nullable|') . 'image|mimes:jpeg,jpg,png,gif,webp|'.upload_file_rule();

        return [
            'name' => 'required|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'designation' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:50',
            'password' => 'nullable|min:8|confirmed',
            'image' => $imageRule,
            'description' => 'required|string|max:5000',
            'trainer_types' => 'required|array|min:1',
            'trainer_types.*' => ['required', 'string', Rule::exists('categories', 'slug')->where(fn ($q) => $q->where('status', 1))],
            'price' => 'required|string|max:50',
            'state' => 'required|string|max:100',
            'city' => 'required|string|max:100',
            'zip_code' => 'nullable|string|max:20',
            'workplace' => 'nullable|string|max:255',
            'gym_name' => 'nullable|string|max:255',
            'specialization' => 'nullable|array',
            'specialization.*' => 'nullable|string|max:255',
            'facebook' => 'nullable|string|max:500',
            'twitter' => 'nullable|string|max:500',
            'instagram' => 'nullable|string|max:500',
            'linkedin' => 'nullable|string|max:500',
            'youtube' => 'nullable|string|max:500',
        ];
    }

    public static function syncFromRequest(Request $request, User $user, Trainer $trainer): Trainer
    {
        return DB::transaction(function () use ($request, $user, $trainer) {
            $specializations = collect($request->input('specialization', []))
                ->map(fn ($item) => trim((string) $item))
                ->filter()
                ->values()
                ->all();

            $types = collect($request->input('trainer_types', []))
                ->map(fn ($slug) => trim((string) $slug))
                ->filter()
                ->unique()
                ->values()
                ->all();

            $deliveryModes = self::normalizedDeliveryModes($request);
            $categoryId = self::categoryIdFromSlugs($types);

            // Coach listing → trainers table (by trainer id, not users)
            Trainer::query()->whereKey($trainer->id)->update([
                'trainer_type' => implode(',', $types),
                'delivery_modes' => $deliveryModes,
                'description' => $request->description,
                'price' => $request->price,
                'specialization' => $specializations ? json_encode($specializations) : null,
                'city' => $request->city,
                'state' => $request->state,
                'zip_code' => $request->filled('zip_code') ? trim((string) $request->zip_code) : null,
                'workplace' => $request->filled('workplace') ? trim((string) $request->workplace) : null,
                'gym_name' => $request->filled('gym_name') ? trim((string) $request->gym_name) : null,
                'status' => $user->status == 1 ? 1 : 0,
            ]);

            User::withoutEvents(function () use ($request, $user, $categoryId) {
                $user->name = $request->name;
                $user->last_name = $request->last_name;
                $user->designation = $request->designation;
                $user->email = $request->email;
                $user->phone = $request->phone;
                $user->facebook = $request->facebook;
                $user->twitter = $request->twitter;
                $user->instagram = $request->instagram;
                $user->linkedin = $request->linkedin;
                $user->youtube = $request->youtube;
                $user->category_id = $categoryId;

                if ($request->filled('password')) {
                    $user->password = Hash::make($request->password);
                }

                if ($request->hasFile('image')) {
                    if ($user->image && file_exists(public_path('admin/assets/images/UserImage/' . $user->image))) {
                        @unlink(public_path('admin/assets/images/UserImage/' . $user->image));
                    }

                    $imageName = date('YmdHis') . '.' . $request->file('image')->getClientOriginalExtension();
                    $request->file('image')->move(public_path('admin/assets/images/UserImage'), $imageName);
                    $user->image = $imageName;
                }

                $user->save();
            });

            self::pruneDuplicateTrainerRows($user->id, $trainer->id);

            return self::resolveTrainer($user);
        });
    }

    public static function normalizedDeliveryModes(Request $request): ?string
    {
        $modes = [];

        if ($request->boolean('delivery_online')) {
            $modes[] = 'online';
        }

        if ($request->boolean('delivery_in_person')) {
            $modes[] = 'in_person';
        }

        return count($modes) ? implode(',', $modes) : null;
    }

    public static function isProfileComplete(Trainer $trainer): bool
    {
        $attrs = $trainer->getAttributes();

        return !empty($attrs['description'])
            && !empty($attrs['trainer_type'])
            && !empty($attrs['price'])
            && !empty($attrs['city'])
            && !empty($attrs['state'])
            && !empty($attrs['delivery_modes']);
    }
}
