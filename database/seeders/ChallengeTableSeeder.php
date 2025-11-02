<?php

namespace Database\Seeders;

use App\Models\Challenge;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ChallengeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $myChallenge = new Challenge();
        $myChallenge->title = "sub 20 5k";
        $myChallenge->description = "must upload proof of Strava activity";
        $myChallenge->start_date = "2025-11-02";
        $myChallenge->end_date = "2025-11-16";
        $myChallenge->coach_id = 1; // Connor is a coach
        $myChallenge->save();

        Challenge::factory()->count(30)->create();
    }
}
