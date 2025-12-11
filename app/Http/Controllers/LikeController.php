<?php

namespace App\Http\Controllers;

use App\Models\Attempt;
use Illuminate\Http\Request;
use App\Models\Like;

use App\Notifications\AttemptInteracted;

class LikeController extends Controller
{
    public function store($id, Request $request)
    {
        $attempt = Attempt::findOrFail($id);
        $like = $attempt->likes()->firstOrCreate(['attempt_id' => $attempt->id, 'user_id' => auth()->user()->id]);

        if ($like->wasRecentlyCreated) {
            $attempt->increment('num_likes');
        }

        // Send the user a notification of the comment
        $user = $like->user; 
        $attempt->user->notify(new AttemptInteracted($user, $attempt, 'like', null));

        return redirect()->route('attempts.show', $attempt->id);
    }

    public function destroy($id)
    {
        $attempt = Attempt::findOrFail($id);
        $attempt->likes()->where( 'user_id', auth()->user()->id)->delete();

        $attempt->decrement('num_likes');

        return redirect()->route('attempts.show', $attempt->id);
    }
}
