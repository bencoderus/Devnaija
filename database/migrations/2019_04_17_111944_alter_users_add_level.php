<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->string('photo')->nullable();
            $table->string('mobileno')->nullable();
            $table->string('bio')->nullable();
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
