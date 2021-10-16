<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Game;
use App\Models\UserScore;

class BoardController extends Controller
{
    function index(){

        $user = User::game_ids(10);

        return view('scoreboard')->with('users', $user);
    }



}
