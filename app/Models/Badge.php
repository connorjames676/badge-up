<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Badge extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class, 'participant_id');
    }

    public function challenge() 
    {
        return $this->belongsTo(Challenge::class);
    }
}
