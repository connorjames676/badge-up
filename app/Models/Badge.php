<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Badge extends Model
{
    use HasFactory;

    public function myUser()
    {
        return $this->belongsTo(MyUser::class, 'participant_id');
    }

    public function challenge() 
    {
        return $this->belongsTo(Challenge::class);
    }
}
