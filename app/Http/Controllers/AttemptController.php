<?php

namespace App\Http\Controllers;

use App\Models\Attempt;
use App\Models\Badge;
use App\Models\Challenge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AttemptController extends Controller
{
    public function index()
    {
        $attempts = Attempt::orderByDesc('created_at')->paginate(4);
        return view('attempts.index', ['attempts' => $attempts]);
    }

    public function create($id)
    {
        return view('attempts.create', ['id' => $id]);
    }

    public function store($id, Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
		    'description' => 'required|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg',
		]);

        $imageName = null;
        if ($request->hasFile('image')) {
            // Code obtained from Stackoverflow: "How to upload an image using Laravel?"
            $imageName = time().'.'.request()->image->getClientOriginalExtension();
            $request->image->move(public_path(path: 'attempts'), $imageName);
        }

        $attempt = Attempt::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => auth()->user()->id,
            'challenge_id' => $id,
            'image' => $imageName,
        ]);

        session()->flash('message', 'Attempt was created.');
        
        return redirect()->route('attempts.show', $attempt->id);
    }

    public function show($id)
    {
        $attempt = Attempt::with('user')->with('comments')->findOrFail($id);
        $isAdmin = auth()->user()->role == 'admin';
        $comments = $attempt->comments()->paginate(3);

        $hasBeenApproved = $attempt->approved;

        return view('attempts.show', [
            'attempt' => $attempt,
            'isAdmin' => $isAdmin,
            'comments' => $comments,
            'hasBeenApproved' => $hasBeenApproved
        ]);
    }

    public function edit($id)
    {
        $attempt = Attempt::findOrFail($id);
        $challenge_id = $attempt->challenge_id;
        return view('attempts.edit', ['attempt' => $attempt, 'challenge_id' => $challenge_id]);
    }

    public function update($id, Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
		    'description' => 'required|max:255',
		]);

        $attempt = Attempt::findOrFail($id);
        $attempt->title = $validatedData['title'];
        $attempt->description = $validatedData['description'];
        $attempt->save();
        
        session()->flash('message', 'Attempt was updated.');
        
        return redirect()->route('attempts.show', $attempt->id);
    }

    public function destroy($id)
    {
        $attempt = Attempt::findOrFail($id);
        $challlenge = Challenge::findOrFail($attempt->challenge_id);

        foreach($attempt->comments as $comment) {
            $comment->delete();
        }

        foreach($attempt->likes as $like) {
            $like->delete();
        }

        $attempt->delete();

        session()->flash('message', 'Attempt was deleted.');

        return redirect()->route('challenges.show', $challlenge->id);
    }

    public function approve($id) {
        $attempt = Attempt::findOrFail($id);

        // Update attempt
        $attempt->approved = True;
        $attempt->save();

        // Create badge
        $badge = new Badge();
        $badge->title = $attempt->challenge->title;
        $badge->description = $attempt->challenge->description;
        $badge->participant_id = $attempt->user->id;
        $badge->challenge_id = $attempt->challenge->id;
        $badge->save();

        // Update profile
        $profile = $attempt->user->profile;
        $profile->number_of_badges++;
        $profile->save();

        return redirect()->route('attempts.show', $attempt->id);
    }
}
