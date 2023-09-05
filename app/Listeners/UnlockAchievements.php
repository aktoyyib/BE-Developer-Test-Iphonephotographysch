<?php

namespace App\Listeners;

use App\Events\AchievementUnlocked;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\LessonWatched;
use App\Events\CommentWritten; 
use App\Models\Achievements;

class UnlockAchievements
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
    public function handle(object $event): void
    {
        $user = $event->user; 

        if ($event instanceof LessonWatched) 
        {
            // Handle LessonWatched event 
            $lessonsWatched = $user->watched()->count(); 

            $achievement = Achievements::where([['type', '=', 'lesson'], ['threshold', '=', $lessonsWatched]])->first();

            if (!empty($achievement)) 
            { 
                event(new AchievementUnlocked($achievement->name, $achievement, $user));
            }
        } 
        elseif ($event instanceof CommentWritten) 
        { 
            // Handle CommentWritten event
            $commentsCount = $user->comment()->count();

            $achievement = Achievements::where([['type', '=', 'comment'], ['threshold', '=', $commentsCount]])->first();

            if (!empty($achievement)) 
            {
                event(new AchievementUnlocked($achievement->name, $achievement, $user));
            }
        }
    }
}
