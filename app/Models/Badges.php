<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\BadgeConfig;

class Badges extends Model
{
    use HasFactory, BadgeConfig;

    protected $fillable = [
        'name',
        'description',
        'threshold',
        'isDefault'
    ];
}
