<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainerReview extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function trainer()
    {
        return $this->belongsTo(Trainer::class);
    }
}
