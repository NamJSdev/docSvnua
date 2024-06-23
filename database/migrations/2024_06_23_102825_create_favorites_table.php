<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFavoritesTable extends Migration
{
    public function up()
    {
        Schema::create('favorites', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('postID');
            $table->unsignedBigInteger('accountID');
            $table->timestamps();

            $table->foreign('postID')->references('id')->on('posts')->onDelete('cascade');
            $table->foreign('accountID')->references('id')->on('accounts')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('favorites');
    }
}