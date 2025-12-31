<?php

namespace App\Models;



use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model; 

class ContactUs extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function hasCategory()
    {
        return $this->hasOne(Category::class, 'slug' , 'service');
    }
}
