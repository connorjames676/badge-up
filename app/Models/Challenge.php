<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Challenge extends Model
{
    use HasFactory;

    public function my_users()
    {
        return $this->belongsTo(MyUser::class, 'coach_id');
    }

    public function participants()
    {
        return $this->belongsToMany(MyUser::class,'challenge_my_user', 
            'challenge_id', 'participant_id');
    }
}
