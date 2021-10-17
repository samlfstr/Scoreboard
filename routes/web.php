<?php

use App\Http\Controllers\BoardController;
use App\Models\UserScore;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/scoreboard/games', [BoardController::class, 'get_games']);
Route::pattern('game_id', '[0-9]+');
Route::get('/scoreboard/games/{game_id}', [BoardController::class, 'get_scoreboard']);
Route::put('/scoreboard/add', [BoardController::class, 'add_score']);
