<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('nickname')->nullable()->after('name');
            $table->string('phone')->nullable()->after('email');
            $table->string('line_id')->nullable()->after('email');
            $table->string('address')->nullable()->after('line_id');
            $table->string('leader_id')->nullable()->after('ig_account');
            $table->string('authorization_code')->nullable()->after('leader_id');
            $table->string('image')->nullable()->after('authorization_code');
            $table->string('milage')->nullable()->after('image');
            $table->string('level')->nullable()->after('milage');
            $table->string('role');
            $table->string('remarks')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('nickname');
            $table->dropColumn('phone');
            $table->dropColumn('line_id');
            $table->dropColumn('address');
            $table->dropColumn('leader_id');
            $table->dropColumn('authorization_code');
            $table->dropColumn('image');
            $table->dropColumn('level');
            $table->dropColumn('milage');
            $table->dropColumn('role');
            $table->dropColumn('remarks');
        });
    }
}
