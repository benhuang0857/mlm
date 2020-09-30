<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMultiLevelToCategory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('category', function (Blueprint $table) {
            $table->integer('a_level');
            $table->integer('b_level');
            $table->integer('c_level');
            $table->integer('d_level');
            $table->integer('e_level');
            $table->integer('f_level');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('category', function (Blueprint $table) {
            $table->dropColumn('a_level');
            $table->dropColumn('b_level');
            $table->dropColumn('c_level');
            $table->dropColumn('d_level');
            $table->dropColumn('e_level');
            $table->dropColumn('f_level');
        });
    }
}
