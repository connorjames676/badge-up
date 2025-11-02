<?php

namespace Database\Seeders;

use App\Models\Profile;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProfileTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $myProfile = new Profile;
        $myProfile->bio = "I'm Connor!";
        $myProfile->number_of_badges = 14;
        $myProfile->my_user_id = 1; // Connor
        $myProfile->save();

        Profile::factory()->count(50)->create();
    }
}
