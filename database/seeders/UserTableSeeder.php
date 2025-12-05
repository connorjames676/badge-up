<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $me = new User;
        $me->name = "Connor James";
        $me->email = "2326609@swansea.ac.uk";
        $me->password = "password";
        $me->age = 20;
        $me->role = "coach";
        $me->save();

        User::factory()->count(50)->create();
    }
}
