<?php

namespace App\Http\Controllers;

use App\Models\Challenge;
use Illuminate\Http\Request;

class ChallengeController extends Controller
{
    public function index()
    {
        $challenges = Challenge::all();
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
		    'description' => 'required|max:255',
		    'start_date' => 'required|date|after:now',
		    'end_date' => 'required|date|after:start_date',
		]);
		
		//return "Passed Validation";

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
        return view('challenges.show', ['challenge' => $challenge]);
    }
}
