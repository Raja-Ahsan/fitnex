<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    /**
     * Labels + slugs for the public header ("Find a wellness professional" / "Join as a coach").
     * Lives on the model (not CategoryController) because the header needs this on every
     * frontend page; CategoryController only runs for admin service CRUD routes.
     *
     * @return array<int, array{label: string, slug: string}>
     */
    public static function wellnessNavSpecs(): array
    {
        $wellnessSpecs = [];
        foreach (
            static::query()
                ->where('status', 1)
                ->orderBy('id')
                ->get(['title', 'slug']) as $category
        ) {
            $wellnessSpecs[] = [
                'label' => $category->title,
                'slug' => $category->slug,
            ];
        }

        if ($wellnessSpecs === []) {
            return config('wellness_nav.specialties', []);
        }

        return $wellnessSpecs;
    }

    public function hasCreatedBy()
    {
        return $this->hasOne(User::class, 'id', 'created_by');
    }

}
