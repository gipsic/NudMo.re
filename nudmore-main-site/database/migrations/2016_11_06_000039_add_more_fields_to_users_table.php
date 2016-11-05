<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMoreFieldsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('username')->after('id')->unique();
            $table->dropColumn(['email', 'password', 'name']);
        });
        Schema::table('users', function (Blueprint $table) {
            $table->string('password')->after('username');
            $table->string('email')->after('password')->unique();
            $table->string('title')->after('email');
            $table->string('name')->after('title');
            $table->string('surname')->after('name');
            $table->string('gender')->after('surname');
            $table->string('identity_number', 13)->after('gender');
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
            $table->dropColumn(['username', 'title', 'surname', 'gender', 'identity_number']);
        });
    }
}
