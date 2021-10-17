<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserScore extends Model
{
    protected $table = "user_scores";
    use HasFactory;

    /*select count(*) as total_play_count from user_scores where game_id_fk = 21;*/
    static function total_play_count($game_id): int
    {
        return UserScore::query()
            ->select('game_id_fk')
            ->where('game_id_fk', '=', $game_id)
            ->count();
    }

}
