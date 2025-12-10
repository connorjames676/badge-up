<?php

namespace App\Http\Controllers;

use App\Models\Attempt;
use App\Notifications\AttemptInteracted;
use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    public function create($id)
    {
        $attempt = Attempt::findOrFail($id);
        return view('comments.create', ['attempt' => $attempt]);
    }

    public function store(Attempt $attempt, Request $request)
    {
        $validatedData = $request->validate([
            'content' => 'required|max:255',
		]);

        $comment = new Comment();
        $comment->content = $validatedData['content'];
        $comment->user_id = auth()->user()->id;
        $comment->attempt_id = $attempt->id;
        $comment->save();

        $attempt->increment('num_comments');

       // Send the user a notification of the comment
        $user = $comment->user; 
        $attempt->user->notify(new AttemptInteracted($user, $attempt, 'like', null));
        
        session()->flash('message', 'Comment was created.');
        
        return redirect()->route('attempts.show', $attempt->id);
    }

    public function edit(Attempt $attempt, Comment $comment)
    {
        return view('comments.edit', ['attempt' => $attempt, 'comment' => $comment]);
    }

    public function update(Attempt $attempt, Comment $comment, Request $request)
    {
        $validatedData = $request->validate([
            'content' => 'sometimes|required|max:255',
		]);

        $comment->content = $validatedData['content'];
        $comment->save();
        
        session()->flash('message', 'Comment was updated.');
        
        return redirect()->route('attempts.show', $attempt->id);
    }

    public function destroy(Attempt $attempt, Comment $comment)
    {
        $comment->delete();

        $attempt->decrement('num_comments');

        session()->flash('message', 'Comment was deleted.');

        return redirect()->route('attempts.show', $attempt->id);
    }
}
