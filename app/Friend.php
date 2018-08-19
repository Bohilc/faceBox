<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\helpers;

class Friend extends Model
{
    protected $fillable = [
        'user_id', 'friend_id', 'accepted'
    ];
}
