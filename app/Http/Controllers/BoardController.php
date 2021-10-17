<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Game;
use App\Models\UserScore;
use Illuminate\Support\Facades\DB;

/*
[add_score]
Bir oyuncu oyunu bitirdiğinde kullanılacak metod.
(In: {game_id: ,user_id: , score: }
(Out: [{old_rank: “Önceki Sıralama”, new_rank: “Şimdiki Sıralama”, sweep: [1,2,3,4,5] (Bu oyunla sıralamada geçtiği kullanıcılar*)}
*/

class BoardController extends Controller
{
    function updateRank($game_id): array
    {
        $out = [];
        $rank = 1;
        $game_scores = UserScore::get_scores($game_id)->unique('user_id_fk');

        foreach($game_scores as $score){
            array_push($out,
                [
                    'game_id' => $score->game_id_fk,
                    'user_id' => $score->user_id_fk,
                    'score' => $score->score,
                    'rank' => $rank
                ]
            );
            UserScore::update_rank($score->user_id_fk, $score->game_id_fk, $rank);
            $rank++;
        }
        return $out;
    }

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
        return json_encode($this->updateRank($game_id));
    }

    function add_score(Request $request)
    {
        $score = new UserScore();
        $score->user_id_fk = $request->input('user_id_fk');
        $score->game_id_fk = $request->input('game_id_fk');
        $score->score = $request->input('score');

        // old rank & new rank missing...

    }


}
