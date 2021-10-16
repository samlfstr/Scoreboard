<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = "users";
    use HasFactory;

    static function game_ids($val){
        return User::query()->where('game_id_fk', '=', $val)->get();
    }
}
