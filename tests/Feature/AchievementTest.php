<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Database\Factories\UserFactory;
use Database\Factories\LessonFactory;  
use App\Models\User;
use App\Models\Achievements;
use App\Models\Badges;
use App\Events\LessonWatched; 
use App\Events\AchievementUnlocked;
use App\Events\BadgeUnlocked;

class AchievementTest extends TestCase
{
    use DatabaseTransactions;
    
    // Test that a user can watch a lesson

    public function test_user_watches_a_lesson()
    { 
        $user = UserFactory::new()->create();
        $lesson = LessonFactory::new()->create(); 

        event(new LessonWatched($lesson, $user)); 

        $this->assertDatabaseHas('lesson_user', [
            'user_id' => $user->id,
            'lesson_id' => $lesson->id,
            'watched' => true,
        ]); 
    } 

    // Test that a user can unlock an achievement 

    public function test_user_achievements_are_correctly_recorded_in_database()
    { 
        $user = UserFactory::new()->create();
        $achievement = Achievements::orderBy('threshold', 'ASC')->first();  

        event(new AchievementUnlocked($achievement->name, $achievement, $user)); 

        $this->assertDatabaseHas('user_achievements', [
            'user_id' => $user->id,
            'achievement_id' => $achievement->id,
            'achievement_name' => $achievement->name,
        ]); 
    }    

    // Test that a user can unlock at least one badge 
    public function test_user_badges_are_correctly_recorded_in_database()
    {   
        $user = UserFactory::new()->create();
        $badge = Badges::orderBy('threshold', 'ASC')->first(); 

        event(new BadgeUnlocked($badge->name, $badge, $user)); 

        $this->assertDatabaseHas('user_badges', [
            'user_id' => $user->id,
            'badge_id' => $badge->id,
            'badge_name' => $badge->name,
        ]);  
    }


    //Test that the endpoint asserts to 200 and that it returns the right response

    public function test_achievements_endpoint_returns_correct_response()
    { 
        $user = User::factory()->create();

        $response = $this->get("/users/".$user->id."/achievements");

        $response->assertStatus(200);

        $response->assertJsonStructure(
            [
                'unlocked_achievements',
                'next_available_achievements',
                'current_badge',
                'next_badge',
                'remaing_to_unlock_next_badge'
            ]
        );
    }
}
