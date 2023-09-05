<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany; 

class Achievements extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'threshold'
    ];

    public function user_achievement(): HasMany
    {
        return $this->hasMany(UserAchievement::class, 'achievement_id');
    }
}
