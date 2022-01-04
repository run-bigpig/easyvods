<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvSourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ev_sources', function (Blueprint $table) {
            $table->id();
            $table->string("name")->comment("资源站名称");
            $table->string("url")->comment("资源站api地址");
            $table->string("type")->comment("api类型 xml/json")->default("xml");
            $table->tinyInteger("status")->comment("状态 0关闭 1开启")->default(0);
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
        Schema::dropIfExists('ev_sources');
    }
}
