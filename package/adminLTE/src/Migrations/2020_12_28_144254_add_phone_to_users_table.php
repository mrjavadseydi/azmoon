<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPhoneToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('super_admin')->default(false);
            $table->string('mobile',12)->default(0);
            $table->boolean('phone_verify')->default(false);
            $table->dateTime('phone_verify_at')->default(\Illuminate\Support\Carbon::now());
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
            $table->dropColumn('super_admin');
            $table->dropColumn('mobile',12);
            $table->dropColumn('phone_verify');
            $table->dropColumn('phone_verify_at');
        });
    }
}
