<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = "users";
    use HasFactory;

    static function the_game($game_id){
       return User::all();
    }

}

