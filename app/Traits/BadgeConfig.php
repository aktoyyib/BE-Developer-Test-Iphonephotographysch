<?php

namespace App\Traits;

use App\Models\Badges;


trait BadgeConfig
{
	// Returns the default badge
    public function defaultBadge() 
    {
        return Badges::select('id', 'name', 'threshold', 'isDefault')
        				->where('isDefault', true)
        				->first();
    }
}