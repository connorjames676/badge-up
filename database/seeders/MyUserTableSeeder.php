<?php

namespace Database\Seeders;

use App\Models\MyUser;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MyUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $me = new MyUser;
        $me->name = "Connor";
        $me->email = "2326609@swansea.ac.uk";
        $me->password = "password";
        $me->age = 20;
        $me->role = "coach";
        $me->save();

        MyUser::factory()->count(50)->create();
    }
}
