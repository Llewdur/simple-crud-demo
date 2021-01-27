<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyUsers extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('surname')->after('name');
            $table->string('idnumber')->unique()->after('surname');
            $table->string('mobile')->after('idnumber');
            $table->date('dob')->after('mobile');
            $table->integer('language_id')->after('dob');

            $table->foreign('language_id')->references('id')->on('languages');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('users_language_id_foreign');

            $table->dropColumn([
                'surname',
                'idnumber',
                'mobile',
                'dob',
                'language_id',
            ]);
        });
    }
}
