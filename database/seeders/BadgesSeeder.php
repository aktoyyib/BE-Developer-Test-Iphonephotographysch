<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Badges;

class BadgesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $badges = [
            [
                'name' => 'Beginner',
                'description' => '0 Achievements',
                'threshold' => 0, // The Beginner badge doesn't require any achievements
                'isDefault' => true
            ],
            [
                'name' => 'Intermediate',
                'description' => 'Requires 4 Achievements',
                'threshold' => 4, // Requires 4 achievements to earn
                'isDefault' => false
            ],
            [
                'name' => 'Advanced',
                'description' => 'Requires 8 Achievements',
                'threshold' => 8, // Requires 8 achievements to earn
                'isDefault' => false
            ],
            [
                'name' => 'Master',
                'description' => 'Requires 10 Achievements',
                'threshold' => 10, // Requires 10 achievements to earn
                'isDefault' => false
            ],
        ];

        // Insert data into the badges table
        Badges::insert($badges); 
    }
}
