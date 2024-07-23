<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostTagsTable extends Migration
{
    public function up()
    {
        Schema::create('post_tags', function (Blueprint $table) {
            $table->unsignedBigInteger('tagID');
            $table->unsignedBigInteger('postID');
            $table->timestamps();

            $table->foreign('tagID')->references('id')->on('tags')->onDelete('cascade');
            $table->foreign('postID')->references('id')->on('posts')->onDelete('cascade');
            $table->primary(['tagID', 'postID']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('post_tags');
    }
}