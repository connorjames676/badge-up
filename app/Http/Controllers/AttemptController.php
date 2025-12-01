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

    public function show($id)
    {
        $attempt = Attempt::with('user')->with('comments')->findOrFail($id);
        return view('attempts.show', ['attempt' => $attempt]);
    }

    public function edit($id)
    {
        $attempt = Attempt::findOrFail($id);
        return view('attempts.edit', ['attempt' => $attempt]);
    }

    public function update($id, Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'sometimes|required|max:255',
		    'description' => 'sometimes|required|max:255',
		]);

        $attempt = Attempt::findOrFail($id);
        $attempt->title = $validatedData['title'];
        $attempt->description = $validatedData['description'];
        $attempt->save();
        //$attempt->update($validatedData);
        
        session()->flash('message', 'Attempt was updated.');
        
        return redirect()->route('attempts.show', $attempt->id);
    }

    public function destroy($id)
    {
        $attempt = Attempt::findOrFail($id);
        $attempt->delete();

        session()->flash('message', 'Attempt was deleted.');

        return redirect()->route('attempts.index');
    }
}
