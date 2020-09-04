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
            $table->string('fb_account')->nullable();
            $table->string('ig_account')->nullable()->after('fb_account');
            $table->string('leader_id')->nullable()->after('ig_account');
            $table->string('authorization_code')->nullable()->after('leader_id');
            $table->string('image')->nullable()->after('authorization_code');
            $table->string('milage')->nullable()->after('image');
            $table->string('levelcat01')->nullable()->after('milage');
            $table->string('levelcat02')->nullable()->after('milage');
            $table->integer('cat01num')->nullable()->after('milage');
            $table->integer('cat02num')->nullable()->after('milage');
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
            $table->dropColumn('fb_account');
            $table->dropColumn('ig_account')->nullable();
            $table->dropColumn('leader_id');
            $table->dropColumn('authorization_code');
            $table->dropColumn('image')->nullable();
            $table->dropColumn('milage');
            $table->dropColumn('levelcat01');
            $table->dropColumn('levelcat02');
            $table->dropColumn('cat01num');
            $table->dropColumn('cat02num');
            $table->dropColumn('role');
            $table->dropColumn('remarks');
        });
    }
}
