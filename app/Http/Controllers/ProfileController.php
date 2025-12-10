<?php

namespace App\Http\Controllers;

use App\Models\Badge;
use App\Models\Profile;
use App\Models\User;
use DB;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show($id)
    {
        $user = User::findOrFail($id);
        $isAdmin = $user->role == "admin";

        //$items = $user->attempts->merge($user->comments)->sortByDesc('created_at');

        $attempts = $user->attempts()->orderByDesc('created_at')->paginate(3);
        $comments = $user->comments()->orderByDesc('created_at')->paginate(3);

        return view('profile.show', [
            'user' => $user,
            'isAdmin' => $isAdmin,
            'attempts' => $attempts,
            //'items' => $items,
            'comments' => $comments
        ]);
    }

    public function bioEdit()
    {
        return view('profile.edit-bio');
    }

    public function bioUpdate($id, Request $request)
    {
        $validatedData = $request->validate([
            'bio' => 'sometimes|required|max:255',
		]);

        //$profile = auth()->user()->profile;
        $profile = Profile::findOrFail($id);
        $profile->bio = $validatedData['bio'];
        $profile->save();
        
        session()->flash('message', 'Bio was updated.');
        
        return redirect()->route('profile.show', auth()->user());
    }

    public function badges(User $user)
    {
        $badges = Badge::where('participant_id', $user->id)->orderByDesc('created_at')->paginate(5);
        
        return view('badges.index', ['user' => $user, 'badges' => $badges]);
    }
}
