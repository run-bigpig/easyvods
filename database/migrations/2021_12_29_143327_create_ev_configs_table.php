<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvConfigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ev_configs', function (Blueprint $table) {
            $table->id();
            $table->string("name")->comment("网站名称")->default("EasyVod");
            $table->string("logo")->comment("网站logo")->default("");
            $table->string("email")->comment("站长邮箱")->default("admin@easyvods.com");
            $table->string("icp")->comment("ICP")->nullable();
            $table->string("keywords")->comment("网站关键字")->default("easyvod");
            $table->string("content")->comment("网站描述")->default("easyvod");
            $table->mediumText("tj")->comment("统计代码")->nullable();
            $table->mediumText("notice")->comment("网站公告")->nullable();
            $table->tinyInteger("cache")->comment("全站缓存 0关闭 1开启")->nullable();
            $table->string("method")->comment("目标站")->default("qihu");
            $table->string("template")->comment("模板")->default("dyxs");
            $table->tinyInteger("status")->comment("网站状态 0关闭 1开启")->default(0);
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
        Schema::dropIfExists('ev_configs');
    }
}
