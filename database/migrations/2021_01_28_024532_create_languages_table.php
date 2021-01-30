<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLanguagesTable extends Migration
{
    public function up()
    {
        Schema::create('languages', function (Blueprint $table) {
            $table->tinyInteger('id')->autoIncrement()->unsigned();
            $table->string('name')->unique();
            $table->string('code', 10)->unique();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('languages');
    }
}
