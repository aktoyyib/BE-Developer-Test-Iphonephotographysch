<?php

namespace App\Services;

use App\Models\UserAchievement; 
use App\Models\Achievements;
use App\Models\Badges;

class AchievementService
{    
	public function fetchNextBadge($currentBadgeThreshold)
	{
		return Badges::select('name', 'threshold')
						->where('threshold', '>', $currentBadgeThreshold)
						->orderBy('threshold', 'ASC')
						->first();
	}

	public function getNextAvailableAchievements(array $achievementIDs, $userID)
	{
		$selectedColumn = 'name';

		$results = Achievements::whereDoesntHave('user_achievement', function ($query) use ($userID) {
				            $query->where('user_id', '=', $userID);
				        })
						->select('type', 'name')
						->orderBy('threshold', 'ASC') 
						->get()
						->groupBy('type');
		
		// $minValues = $results->pluck('threshold');
		// $selectedValues = $results->pluck($selectedColumn);

		return $results;
	}

	public function computeNextAvailableAchievements($nextAvailableAchievements = [])
	{
		$next_available_achiements = [];

		if (!empty($nextAvailableAchievements)) 
		{ 
			foreach (array_keys($nextAvailableAchievements->toArray()) as $achievementType) 
			{
				array_push($next_available_achiements, $nextAvailableAchievements[$achievementType][0]['name']);
			}
		}


		return $next_available_achiements;
	}
}

