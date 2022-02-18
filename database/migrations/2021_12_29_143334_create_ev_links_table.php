<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ev_links', function (Blueprint $table) {
            $table->id();
            $table->string("name")->comment("友链名称");
            $table->string("url")->comment("友链地址");
            $table->integer("sort")->comment("排序 数字越大越靠前");
            $table->tinyInteger("status")->comment("状态 0隐藏 1开启")->default(1);
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
        Schema::dropIfExists('ev_links');
    }
}
