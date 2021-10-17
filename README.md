# Laravel ScoreBoard Api
`Version 0.1`

The project has been build using Laravel 8x framework.
ScoreBoard api allows you to retrieve information about a multiplatform game.
It has a 3 main function, and those can be easily accessed using routes.
In this project I used postman as an API tester.

## Table of Contents
* [Prerequisites](#Prerequisites)
* [Installation](#Installation)
* [Structure](#Structure)
* [Tools For Testing](#Tools)

## Prerequisites
<a name="prerequisites"></a>

You need local server (MAMP, WAMP, etc.) to run apache and mysql.

You need a PHP IDE, which I am currently using is [Php Storm](https://www.jetbrains.com/fr-fr/phpstorm/). on MAC.

## Installation
<a name="Installation"></a>

Then install [composer](https://getcomposer.org/).

Install `Laravel Framework` using console, before go to the directory you wanna install you project :
```
composer create-project laravel/laravel <project_name>
```

Make sure that the .env file is set up : `app key & database credentials`

## Structure
<a name="Structure"></a>

> * **Migrations**


<details>
<summary>Migrations allow you to create tables in the database.</summary>

Users Table
```
 Schema::create('users', function (Blueprint $table) {
   $table->id('user_id');
   $table->string('game_id_fk');
   $table->string('user_name');
   $table->integer('highest_score');
   $table->foreign('game_id_fk')->references('game_id')->on('games');
   $table->timestamps();
 });
```

Games Table
```
 Schema::create('games', function (Blueprint $table) {
   $table->id('game_id');
   $table->string('game_title');
   $table->timestamps();
 });
```

Scores Table
```
 Schema::create('user_scores', function (Blueprint $table) {
   $table->id('score_id');
   $table->integer('score');
   $table->string('user_id_fk');
   $table->integer('game_id_fk');
   $table->foreign('user_id_fk')->references('user_id')->on('users');
   $table->foreign('game_id_fk')->references('game_id')->on('games');
   $table->timestamps();
 });
```

</details>


> * **Factories**
<details>
<summary>You can seed data into your tables easily with factories using faker.</summary>

UserFactory
```
 public function definition() : array
 {
     return [
         'game_id_fk' => $this->faker->numberBetween(1, 25),
         'user_name' => $this->faker->name(),
         'highest_score' => $this->faker->numberBetween(1,500)
     ];
 }
```

GameFactory
```
 public function definition(): array
 {
     return ['game_title'=>$this->faker->name()];
 }
```

UserScoreFactory
```
 public function definition() : array
 {
     return [
         'score' => $this->faker->numberBetween(1, 1000),
         'user_id_fk' => $this->faker->numberBetween(1, 100),
         'game_id_fk' => $this->faker->numberBetween(1,25)
     ];
 }
```

Then use DatabaseSeeder to run all factories

```
 public function run()
 {
     Game::factory(25)->create();
     User::factory(25)->create();
     UserScore::factory(50)->create();
 }
```

</details>

> * **Models**
<details>
<summary>They allow you to interreact with database.</summary>

User Model
```
class User extends Model
{
    // Define the database to use
    protected $table = "users";
    use HasFactory;

    // Return all users as obj
    static function users(){
       return User::all();
    }

    /* select count(*) as count from users where game_id_fk = 10;*/
    static function u_users($game_id): int
    {
        return User::query()
            ->select('game_id_fk')
            ->where('game_id_fk', '=', $game_id)
            ->count();
    }
}
```

Game Model
```
class Game extends Model
{
    // Define the database to use
    protected $table = "games";
    use HasFactory;

    static function the_active_games(){
        return Game::all();
    }
}
```

UserScore Model
```
class UserScore extends Model
{   
    // Define the database to use
    protected $table = "user_scores";
    use HasFactory;

    static function scores(): array
    {
        return UserScore::all();
    }

    // Return the count of unique players by game id
    /*select count(*) as total_play_count from user_scores where game_id_fk = 21;*/
    static function total_play_count($game_id): int
    {
        return UserScore::query()
            ->select('game_id_fk')
            ->where('game_id_fk', '=', $game_id)
            ->count();
    }

    // That function returns only 25 scores and unique user scores for a given game id
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

    // Get only user rank
    static function get_user_rank($user_id, $game_id)
    {
        return UserScore::query()
            ->select('user_rank')
            ->where('user_id_fk', '=', $user_id)
            ->where('game_id_fk', '=', $game_id)
            ->get();
    }

    // Update the rank
    static function update_rank($user_id, $game_id, $rank)
    {
        return UserScore::query()
                ->where('user_id_fk','=', $user_id)
                ->where('game_id_fk', '=', $game_id)
                ->update(['user_rank' => $rank]);
    }
}

```
</details>

> * **Routing**
<details>
<summary>It is a very stong tool that allows you to create intelligent routes.</summary>

```
Route::get('/scoreboard/games', [BoardController::class, 'get_games']);
Route::pattern('game_id', '[0-9]+');
Route::get('/scoreboard/games/{game_id}', [BoardController::class, 'get_scoreboard']);
Route::put('/scoreboard/add', [BoardController::class, 'add_score']);

```

</details>

## Tools For Testing
<a name="Tools"></a>

Postman is a very useful tool that allows us sending postdata through localhost :
In order to make it work, we need to use the put mehtod.

<img width="1436" alt="Screenshot 2021-10-18 at 01 51 40" src="https://user-images.githubusercontent.com/28195113/137647907-9eb61bc0-beac-45aa-b373-de8398d77d2e.png">
