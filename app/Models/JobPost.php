<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobPost extends Model
{
    use HasFactory,SoftDeletes;

    protected $guarded = [];

    public function hasCreatedBy()
    {
        return $this->hasOne(User::class, 'id', 'created_by');
    }

    public function hasCategory()
    {
        return $this->hasOne(JobPostCategory::class, 'id', 'job_category_id');
    }

    public function hasCity()
    {
        return $this->hasOne(City::class, 'id', 'city_id'); 
    }

    public function hasState()
    {
        return $this->hasOne(State::class, 'id', 'state_id'); 
    }
}
