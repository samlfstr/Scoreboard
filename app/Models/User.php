<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = "users";
    use HasFactory;

    static function users(){
       return User::all();
    }

    /* select count(*) as count from users where game_id_fk = 10;*/
    static function u_users($game_id): int
    {
        return User::query()
            ->select('game_id_fk')
            ->where('game_id_fk', '=', $game_id)
            ->count();
    }


}

