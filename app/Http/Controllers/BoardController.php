<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Game;
use App\Models\UserScore;

/*
- aktif oyunları
- oyunları daha önce oynamış unique kullanıcı sayısı
- toplam oynama sayısı döndürür
*/
class BoardController extends Controller
{
    function get_games(){

        $out = [];
        $active_games = Game::the_active_games();

        foreach($active_games as $game){
            array_push($out,
                [
                    'game_id' => $game->game_id,
                    'game_title' => $game->game_title,
                    'unique_players' => User::u_users($game->game_id),
                    'total_played_count' => UserScore::total_play_count($game->game_id)

                ]
            );
        }
        return json_encode($out);
    }

    function get_scoreboard(){

    }

    function add_score(){

    }



}
