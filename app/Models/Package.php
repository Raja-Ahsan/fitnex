<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Package extends Model
{
    use HasFactory, SoftDeletes;

    public function hasCreatedBy()
    {
        return $this->hasOne(User::class, 'id', 'created_by');
    }

    public function hasCategory()
    {
        return $this->hasOne(Category::class, 'id', 'parent_id');
    }

    public function hasCategorySlug()
    {
        return $this->hasOne(Category::class, 'slug', 'category_slug');
    }

     // The category this game belongs to
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    // Retrieve the category by slug
    public function categoryBySlug()
    {
        return $this->belongsTo(Category::class, 'category_slug', 'slug');
    }
}
