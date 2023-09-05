<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Achievements;

class AchievementsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $achievements = [
            [
                'name' => 'First Lesson Watched',
                'type' => 'lesson',
                'threshold' => 1
            ],
            [
                'name' => '5 Lessons Watched',
                'type' => 'lesson',
                'threshold' => 5
            ],
            [
                'name' => '10 Lessons Watched',
                'type' => 'lesson',
                'threshold' => 10
            ],
            [
                'name' => '25 Lessons Watched',
                'type' => 'lesson',
                'threshold' => 25
            ],
            [
                'name' => '50 Lessons Watched',
                'type' => 'lesson',
                'threshold' => 50
            ], 
            [
                'name' => 'First Comment Written',
                'type' => 'comment',
                'threshold' => 1
            ],
            [
                'name' => '3 Comments Written',
                'type' => 'comment',
                'threshold' => 3
            ],
            [
                'name' => '5 Comments Written',
                'type' => 'comment',
                'threshold' => 5
            ],
            [
                'name' => '10 Comments Written',
                'type' => 'comment',
                'threshold' => 10
            ],
            [
                'name' => '20 Comments Written',
                'type' => 'comment',
                'threshold' => 20
            ], 
        ];

        // Insert data into the achievements table
        Achievements::insert($achievements);
    }
}
