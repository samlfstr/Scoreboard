<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Game;
use App\Models\UserScore;

class BoardController extends Controller
{
    function index(){
        $user = [
            ['user_id' => '0'],
            ['user_name' => 'Samuel'],
            ['highest_score' => '60']
        ];

        return view('scoreboard')->with('user', $user);
    }



}
