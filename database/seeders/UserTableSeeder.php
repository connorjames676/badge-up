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
        $me->email = "connor@swansea.ac.uk";
        $me->password = "password";
        $me->age = 20;
        $me->role = "coach";
        $me->save();

        // Initialise an admin, admin's cannot be created for security reasons
        $admin = new User;
        $admin->name = "Julian Hough";
        $admin->email = "julian@swansea.ac.uk";
        $admin->password = "password";
        $admin->age = 40;
        $admin->role = "admin";
        $admin->save();

        //User::factory()->count(50)->create();
    }
}
