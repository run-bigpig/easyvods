<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ev_admins', function (Blueprint $table) {
            $table->id();
            $table->string("name")->comment("账号名称")->unique("name");
            $table->string("password")->comment("密码");
            $table->ipAddress("nowloginip")->comment("当前登录IP")->nullable();
            $table->dateTime("nowlogintime")->comment("当前登录时间")->nullable();
            $table->ipAddress("lastloginip")->comment("上次登录IP")->nullable();
            $table->dateTime("lastlogintime")->comment("上次登录时间")->nullable();
            $table->string("api_token")->comment("token")->nullable();
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
        Schema::dropIfExists('ev_admins');
    }
}
