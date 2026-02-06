<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];


    public function hasCreatedBy()
    {
        return $this->hasOne(User::class, 'id', 'created_by');
    }

    public function hasCategory()
    {
        return $this->hasOne(ProjectCategory::class, 'slug', 'parent_id');
    }

    public function documents()
    {
        return $this->hasMany(DocumentRepository::class, 'project_id'); // One project has many documents
    }

    public function hasCity()
    {
        return $this->hasOne(City::class, 'id', 'city_id'); // Check that the city_id field exists in the advertisement table
    }

    public function hasState()
    {
        return $this->hasOne(State::class, 'id', 'state_id'); // Check that the state_id field exists in the advertisement table
    }
}
