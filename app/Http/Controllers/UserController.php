<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index', ['users' => $users]);
    }

    public function create()
    {
        return view('users.create');
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
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

        $user = new User;
        $user->name = $validatedData['name'];
        $user->age = $validatedData['age'];
        $user->role = $validatedData['role'];
        $user->email = $validatedData['email'];
        $user->password = $validatedData['password'];
        $user->save();
        
        session()->flash('message', 'User was created.');
        
        return redirect()->route('users.index');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // Delete profile
        $user->profile()->delete();

        // Remove user from challenges they have joined
        foreach($user->joinChallenges as $challengeJoined) {
            $user->joinChallenges()->wherePivot('challenge_id', $challengeJoined->id)->detach();
        }

        // Delete the user's challenges and everything attached to the challenges
        foreach($user->challenges() as $challenge) {
            foreach($challenge->participants() as $participant) {
                $participant->joinChallenges()->wherePivot('challenge_id', $challenge->id)->detach;
            }
            foreach($challenge->attempts as $attempt) {
                foreach($attempt->comments as $comment) {
                    $comment->delete();
                }
                foreach($attempt->likes as $like) {
                    $like->delete();
                }
                $attempt->delete();
            }
            foreach($challenge->badges as $badge) {
                $badge->delete();
            }
        }

        // Delete the user's attempts along with their likes and comments
        foreach($user->attempts as $attempt) {
            foreach($attempt->comments as $comment) {
                    $comment->delete();
                }
                foreach($attempt->likes as $like) {
                    $like->delete();
                }
                $attempt->delete();
        }

        // Delete the user's comments
        foreach($user->comments as $comment) {
            $comment->delete();
        }

        // Delete the user's likes
        foreach($user->likes as $like) {
            $like->delete();
        }

        // Delete the user's badges
        foreach($user->badges as $badge) {
            $badge->delete();
        }

        // Delete user
        $user->delete();

        return redirect()->route('dashboard');
    }
}
