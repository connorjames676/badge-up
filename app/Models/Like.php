<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    // To allow firstOrCreate to create a Like
    protected $fillable = [
        'user_id',
        'attempt_id',
    ];

    public function myUser()
    {
        return $this->belongsTo(User::class);
    }

    public function attempt()
    {
        return $this->belongsTo(Attempt::class);
    }
}
