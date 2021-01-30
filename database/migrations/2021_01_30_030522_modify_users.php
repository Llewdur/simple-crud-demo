<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyUsers extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('surname')->after('name');
            $table->string('idnumber', 11)->unique()->after('surname');
            $table->string('mobile', 11)->after('idnumber');
            $table->date('dob')->after('mobile');
            $table->tinyInteger('language_id')->after('dob')->unsigned();

            $table->foreign('language_id')->references('id')->on('languages');
        });
    }

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
