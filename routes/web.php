<?php

use App\Http\Controllers\BoardController;
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

Route::get('/scoreboard/games', [BoardController::class, 'active_games']);
Route::get('/scoreboard/games/{id}', [BoardController::class, 'get_games']);
Route::get('/scoreboard/add', [BoardController::class, 'add_score']);
Route::get('/scoreboard', [BoardController::class, 'get_scoreboard']);