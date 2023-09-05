<?php

namespace App\Listeners;

use App\Events\BadgeUnlocked;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\UserBadge;

class BadgeUnlockedListener
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
    public function handle(BadgeUnlocked $event): void
    {
        // Record the achievement in the user_achievements table
        UserBadge::updateOrCreate(
            ['user_id' => $event->user->id],
            [
                'badge_id' => $event->badge->id,
                'badge_name' => $event->badgeName,
            ]
        );
    }
}
