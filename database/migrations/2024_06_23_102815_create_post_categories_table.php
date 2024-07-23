<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostCategoriesTable extends Migration
{
    public function up()
    {
        Schema::create('post_categories', function (Blueprint $table) {
            $table->unsignedBigInteger('categoryID');
            $table->unsignedBigInteger('postID');
            $table->timestamps();

            $table->foreign('categoryID')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('postID')->references('id')->on('posts')->onDelete('cascade');
            $table->primary(['categoryID', 'postID']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('post_categories');
    }
}