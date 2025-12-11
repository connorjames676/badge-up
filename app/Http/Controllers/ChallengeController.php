<?php

namespace App\Http\Controllers;

use App\Models\Challenge;
use Illuminate\Http\Request;
use App\Models\User;

class ChallengeController extends Controller
{
    public function index()
    {
        $challenges = Challenge::orderByDesc('start_date')->paginate(5);
        return view('challenges.index', ['challenges' => $challenges]);
    }

    public function create()
    {
        return view('challenges.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
		    'description' => 'max:255',
		    'start_date' => 'required|date|after:yesterday',
		    'end_date' => 'required|date|after:start_date',
		]);

        $challenge = new Challenge();
        $challenge->title = $validatedData['title'];
        $challenge->description = $validatedData['description'];
        $challenge->start_date = $validatedData['start_date'];
        $challenge->end_date = $validatedData['end_date'];
        $challenge->coach_id = auth()->user()->id;
        $challenge->save();
        
        session()->flash('message', 'Challenge was created.');
        
        return redirect()->route('challenges.index');
    }

    public function show($id)
    {
        $challenge = Challenge::findOrFail($id);
        $hasJoined = auth()->user()->joinChallenges()->where('challenge_id', $challenge->id)->exists();

        $attempts = $challenge->attempts()->paginate(3);

        return view('challenges.show', [
            'challenge' => $challenge,
            'hasJoined' => $hasJoined,
            'attempts' => $attempts
        ]);
    }

    public function edit($id)
    {
        $challenge = Challenge::findOrFail($id);
        return view('challenges.edit', ['challenge' => $challenge]);
    }

    public function update($id, Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
		    'description' => 'max:255',
		    'start_date' => 'required|date|after:$challenge->created_at',
		    'end_date' => 'required|date|after:start_date',
		]);


        $challenge = Challenge::findOrFail($id);
        $challenge->title = $validatedData['title'];
        $challenge->description = $validatedData['description'];
        $challenge->start_date = $validatedData['start_date'];
        $challenge->end_date = $validatedData['end_date'];
        $challenge->save();
        
        session()->flash('message', 'Challenge was updated.');
        
        return redirect()->route('challenges.show', $challenge->id);
    }

    public function destroy($id)
    {
        $challenge = Challenge::findOrFail($id);

        foreach($challenge->attempts as $attempt) {
            $attempt->delete();
        }

        $challenge->delete();

        session()->flash('message', 'Challenge was deleted.');

        return redirect()->route('challenges.index');
    }

    public function join($id)
    {
        $challenge = Challenge::findOrFail($id);
        $user = User::findOrFail(auth()->user()->id);
        $user->joinChallenges()->syncWithoutDetaching([$challenge->id]);

        $hasJoined = auth()->user()->joinChallenges()->where('challenge_id', $challenge->id)->exists();

        return redirect()->route('challenges.show', [$challenge, $hasJoined]);
    }

    public function leave($id)
    {
        $challenge = Challenge::findOrFail($id);
        $user = User::findOrFail(auth()->user()->id);
        $user->joinChallenges()->wherePivot('challenge_id', $challenge->id)->detach();

        $hasJoined = auth()->user()->joinChallenges()->where('challenge_id', $challenge->id)->exists();

        return redirect()->route('challenges.show', [$challenge, $hasJoined]);
    }
}
