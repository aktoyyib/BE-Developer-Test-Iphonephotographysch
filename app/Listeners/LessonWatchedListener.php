<?php

namespace App\Listeners;

use App\Events\LessonWatched;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\UserLesson;

class LessonWatchedListener
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
    public function handle(LessonWatched $event): void
    {
        // Record the achievement in the user_achievements table
        UserLesson::create([
            'user_id' => $event->user->id,
            'lesson_id' => $event->lesson->id,
            'watched' => true,
        ]);
    }
}
