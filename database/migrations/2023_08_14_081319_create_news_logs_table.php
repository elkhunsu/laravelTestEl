<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsLogsTable extends Migration
{
    public function up()
    {
        Schema::create('news_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('news_id');
            $table->string('action');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('news_id')->references('id')->on('articles');
        });
    }

    public function down()
    {
        Schema::dropIfExists('news_logs');
    }
}
