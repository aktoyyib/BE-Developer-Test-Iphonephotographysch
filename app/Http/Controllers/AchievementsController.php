<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Services\AchievementService;
use App\Traits\BadgeConfig; 
use App\Models\Lesson;
use App\Events\LessonWatched;
use App\Models\Comment;
use App\Events\CommentWritten;

class AchievementsController extends Controller
{
    use BadgeConfig;

    protected $achievementService;

    public function __construct(AchievementService $achievementService)
    {
        $this->achievementService = $achievementService;
    }

    public function index(User $user)
    {
        // Retrieve the user's unlocked achievements
        $unlockedAchievements = $user->achievements()->pluck('achievement_name')->toArray();

        $userAchievementIDs = array_column($user->achievements->toArray(), 'achievement_id');

        //Retrieve $nextAvailableAchievements
        $nextAvailableAchievements = $this->achievementService->getNextAvailableAchievements($userAchievementIDs, $user->id); 

        // Retrieve the user's current badge
        $currentBadge = empty($user->badge) ? $this->defaultBadge()->name : $user->badge->badge_name;

        //Fetch next badge details
        $currentBadgeThreshold = empty($user->badge) ? $this->defaultBadge()->threshold : $user->badge->badge->threshold;

        //die(json_encode($currentBadgeThreshold));
        $nextBadge = $this->achievementService->fetchNextBadge($currentBadgeThreshold);

        //Count achievements
        $achievementsCount = $user->achievements()->count();

        $remainingToUnlockNextBadge = !empty($nextBadge) ? ($nextBadge->threshold - $achievementsCount) : 0;

        return response()->json([
            'unlocked_achievements' => $unlockedAchievements,
            'next_available_achievements' => $this->achievementService->computeNextAvailableAchievements($nextAvailableAchievements),
            'current_badge' => $currentBadge,
            'next_badge' => !empty($nextBadge) ? $nextBadge->name : '',
            'remaing_to_unlock_next_badge' => ($remainingToUnlockNextBadge > 0) ? $remainingToUnlockNextBadge : 0
        ]); 
    } 
}
