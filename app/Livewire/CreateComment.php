<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Attempt;
use App\Models\Comment;

use App\Notifications\AttemptInteracted;

class CreateComment extends Component
{
    public $attempt;
    public $content = '';

    public function mount(int $attempt_id)
    {
        $this->attempt = Attempt::findOrFail($attempt_id);
    }

    public function save()
    {
        $this->validate([
            'content' => 'required|string|max:255',
        ]);

        $comment = Comment::create([
            'content' => $this->content,
            'attempt_id' => $this->attempt->id,
            'user_id' => auth()->user()->id,
        ]);

        $this->content = '';

        session()->flash('message', 'Comment was created.');

        $this->attempt->increment('num_comments');

        // Send the user a notification of the comment
        $user = $comment->user; 
        $this->attempt->user->notify(new AttemptInteracted($user, $this->attempt, 'comment', $comment));

        //$this->reset('content');
        //$this->dispatch('comment-added');
    }

    public function render()
    {
        return view('livewire.create-comment');
    }
}
