<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColToCategory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('category', function (Blueprint $table) {
            $table->string('a_name');
            $table->string('b_name');
            $table->string('c_name');
            $table->string('d_name');
            $table->string('e_name');
            $table->string('f_name');
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
            $table->dropColumn('a_name');
            $table->dropColumn('b_name');
            $table->dropColumn('c_name');
            $table->dropColumn('d_name');
            $table->dropColumn('e_name');
            $table->dropColumn('f_name');
        });
    }
}
