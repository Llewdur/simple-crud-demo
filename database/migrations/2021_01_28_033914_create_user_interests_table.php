<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserInterestsTable extends Migration
{
    public function up()
    {
        Schema::create('user_interests', function (Blueprint $table) {
            $table->id();
            $table->integer('interest_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();

            $table->timestamps();

            $table->foreign('interest_id')->references('id')->on('interests');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->unique(['interest_id', 'user_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_interests');
    }
}
