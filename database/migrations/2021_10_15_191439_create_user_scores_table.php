<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserScoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_scores', function (Blueprint $table) {
            $table->id('score_id');
            $table->integer('score');
            $table->string('user_id_fk');
            $table->integer('game_id_fk');
            $table->foreign('user_id_fk')->references('user_id')->on('users');
            $table->foreign('game_id_fk')->references('game_id')->on('games');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_scores');
    }
}
