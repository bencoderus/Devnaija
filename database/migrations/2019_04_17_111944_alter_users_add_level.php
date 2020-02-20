<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterUsersAddLevel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('level')->default(1);
            $table->integer('ban')->default(0);
            $table->string('photo');
            $table->string('mobileno');
            $table->string('bio');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('users', function (Blueprint $table) {
        $table->dropColumn('level');
        $table->dropColumn('ban');
        $table->dropColumn('photo');
        $table->dropColumn('mobileno');
        $table->dropColumn('bio');
    });
    }
}
