<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvPlayersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ev_players', function (Blueprint $table) {
            $table->id();
            $table->string("name")->comment("播放器名称");
            $table->string("url")->comment("播放器地址");
            $table->string("type")->comment("播放器分类")->unique("type");
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
        Schema::dropIfExists('ev_players');
    }
}
