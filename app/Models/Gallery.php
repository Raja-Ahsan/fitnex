<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Gallery extends Model
{
    use HasFactory,SoftDeletes;

    public function hasCreatedBy()
    {
        return $this->hasOne(User::class, 'id', 'created_by');
    }
    
    public function hasGalleryImages()
    {
        return $this->hasMany(GalleryDetail::class, 'galleries_slug', 'slug');
    }

    public function hascategory()
    {
        return $this->hasOne(Category::class, 'id' , 'category_id');
    }
    
}
