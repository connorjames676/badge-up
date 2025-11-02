<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MyUser extends Model
{
    use HasFactory;

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }    

    public function challenges()
    {
        return $this->hasMany(Challenge::class, 'coach_id');
    }

    public function participantChallenges()
    {
        return $this->belongsToMany(Challenge::class,'challenge_my_user',
            'participant_id','challenge_id');
    }
}
