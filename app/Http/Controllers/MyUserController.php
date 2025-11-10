<?php

namespace App\Http\Controllers;

use App\Models\MyUser;
use Illuminate\Http\Request;

class MyUserController extends Controller
{
    public function index()
    {
        $users = MyUser::all();
        return view('users.index', ['users' => $users]);
    }

    public function create()
    {
        return view('users.create');
    }

    public function show($id)
    {
        $user = MyUser::findOrFail($id);
        return view('users.show', ['user' => $user]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
		    'age' => 'required|integer',
		    'role' => 'required|max:255',
		    'email' => 'required|max:255',
            'password' => 'required|max:255',
		]);
		
		//return "Passed Validation";

        $user = new MyUser;
        $user->name = $validatedData['name'];
        $user->age = $validatedData['age'];
        $user->role = $validatedData['role'];
        $user->email = $validatedData['email'];
        $user->password = $validatedData['password'];
        $user->save();
        
        session()->flash('message', 'User was created.');
        
        return redirect()->route('users.index');
    }
}
