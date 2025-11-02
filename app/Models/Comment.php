<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    public function myUser()
    {
        return $this->belongsTo(MyUser::class);
    }

    public function attempt()
    {
        return $this->belongsTo(Attempt::class);
    }
}
