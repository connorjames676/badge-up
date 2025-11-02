<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Challenge extends Model
{
    use HasFactory;

    public function myUser()
    {
        return $this->belongsTo(MyUser::class, 'coach_id');
    }

    public function participants()
    {
        return $this->belongsToMany(MyUser::class,'challenge_my_user', 
            'challenge_id', 'participant_id');
    }

    public function attempts()
    {
        return $this->hasMany(Attempt::class);
    }
}
