<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountsTable extends Migration
{
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->string('password');
            $table->unsignedBigInteger('roleID');
            $table->unsignedBigInteger('infoID');
            $table->string('status')->nullable();
            $table->timestamps();

            $table->foreign('roleID')->references('id')->on('roles')->onDelete('cascade');
            $table->foreign('infoID')->references('id')->on('info')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('accounts');
    }
}