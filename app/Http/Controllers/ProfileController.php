<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use DB;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show()
    {
        //$user = auth()->user();
        //$attempts = DB::table('attempts')->where('user_id', $user->id);

        return view('profile.show');
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
        
        return redirect()->route('profile.show');
    }
}
