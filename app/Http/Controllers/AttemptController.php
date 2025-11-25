<?php

namespace App\Http\Controllers;

use App\Models\Attempt;
use Illuminate\Http\Request;

class AttemptController extends Controller
{
    public function index()
    {
        $attempts = Attempt::all();
        return view('attempts.index', ['attempts' => $attempts]);
    }

    public function create()
    {
        return view('attempts.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
		    'description' => 'required|max:255',
		]);
		
		//return "Passed Validation";

        $attempt = new Attempt();
        $attempt->title = $validatedData['title'];
        $attempt->description = $validatedData['description'];
        $attempt->user_id = auth()->user()->id;
        $attempt->save();
        
        session()->flash('message', 'Attempt was created.');
        
        return redirect()->route('attempts.index');
    }
}
