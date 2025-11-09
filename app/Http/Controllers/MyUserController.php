<?php

namespace App\Http\Controllers;

use App\Models\MyUser;

class MyUserController extends Controller
{
    public function index()
    {
        $users = MyUser::all();
        return view('users.index', ['users' => $users]);
    }
}
