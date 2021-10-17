<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed user_id_fk
 * @property mixed game_id_fk
 * @property mixed score
 * @property mixed user_rank
 */
class UserScore extends Model
{
    protected $table = "user_scores";
    use HasFactory;

    static function scores(): array
    {
        return UserScore::all();
    }

    /*select count(*) as total_play_count from user_scores where game_id_fk = 21;*/
    static function total_play_count($game_id): int
    {
        return UserScore::query()
            ->select('game_id_fk')
            ->where('game_id_fk', '=', $game_id)
            ->count();
    }

    /*select game_id_fk,user_id_fk, score from user_scores where game_id_fk = 25 order by score asc;*/
    static function get_scores($game_id)
    {
        return UserScore::query()
            ->select('user_id_fk', 'game_id_fk', 'score')
            ->where('game_id_fk', '=', $game_id)
            ->orderBy('score', 'desc')
            ->limit(25)
            ->get();
    }

    static function get_user_rank($user_id, $game_id)
    {
        return UserScore::query()
            ->select('user_rank')
            ->where('user_id_fk', '=', $user_id)
            ->where('game_id_fk', '=', $game_id)
            ->get();
    }

    static function update_rank($user_id, $game_id, $rank)
    {
        return UserScore::query()
                ->where('user_id_fk','=', $user_id)
                ->where('game_id_fk', '=', $game_id)
                ->update(['user_rank' => $rank]);
    }




}
