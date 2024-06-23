<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('desc')->nullable();
            $table->string('image')->nullable();
            $table->unsignedBigInteger('docID');
            $table->string('price')->nullable();
            $table->unsignedBigInteger('accountID');
            $table->unsignedBigInteger('categoryID');
            $table->string('status')->default('pending');
            $table->timestamps();

            $table->foreign('docID')->references('id')->on('docs')->onDelete('cascade');
            $table->foreign('accountID')->references('id')->on('accounts')->onDelete('cascade');
            $table->foreign('categoryID')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('posts');
    }
}