<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Game;
use App\Models\UserScore;

/*
[get_scoreboard]
O anki sıralamayı (ilk 25 oyuncu), kullanıcı bilgileri ile birlikte getirir.
(In: {game_id: “Game Id"})
(Out: [{user_id: “Kullanıcı id", score: “skor", rank: “Sıralama” }…...])
*/

class BoardController extends Controller
{
    function get_games()
    {
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

    function get_scoreboard($game_id)
    {
        $out = [];
        $rank = 0;
        $game_scores = UserScore::get_scores($game_id);

        foreach($game_scores as $score){
            array_push($out,
                [
                    'game_id' => $score->game_id_fk,
                    'user_id' => $score->user_id_fk,
                    'score' => $score->score,
                    'rank' => $rank
                ]
            );
            $rank++;
         }

        return json_encode($out);
    }

    function add_score()
    {

    }
}
