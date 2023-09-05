<?php

namespace App\Listeners;

use App\Events\AchievementUnlocked;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue; 
use App\Events\BadgeUnlocked;
use App\Models\Badges;

class UnlockBadges
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(AchievementUnlocked $event): void
    {
        // Check if the user has earned a new badge
        $user = $event->user;
        $achievementsUnlocked = $user->achievements()->count(); 

        //checkIfBadgeUnlocked
        $badge = Badges::where('threshold', '=', $achievementsUnlocked)->first();
        //die(json_encode($achievementsUnlocked));

        if (!empty($badge)) 
        {
            event(new BadgeUnlocked($badge->name, $badge, $user)); 
        } 
    }
}
