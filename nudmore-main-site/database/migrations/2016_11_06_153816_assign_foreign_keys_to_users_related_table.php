<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AssignForeignKeysToUsersRelatedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('patients', function (Blueprint $table) {
            $table->dropColumn(['blood_type']);
        });
        Schema::table('patients', function (Blueprint $table) {
            $table->string('blood_type', 2)->after('patient_number');
            $table->integer('user_id')->length(10)->unsigned()->change();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
        Schema::table('doctors', function (Blueprint $table) {
            $table->integer('user_id')->length(10)->unsigned()->change();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
        Schema::table('staff', function (Blueprint $table) {
            $table->integer('user_id')->length(10)->unsigned()->change();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
        Schema::table('nurses', function (Blueprint $table) {
            $table->integer('user_id')->length(10)->unsigned()->change();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
        Schema::table('pharmacists', function (Blueprint $table) {
            $table->integer('user_id')->length(10)->unsigned()->change();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
        Schema::table('administrators', function (Blueprint $table) {
            $table->integer('user_id')->length(10)->unsigned()->change();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('patients', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn(['blood_type']);
        });
        Schema::table('patients', function (Blueprint $table) {
            $table->enum('blood_type', ['A', 'B', 'O', 'AB']);
        });
        Schema::table('doctors', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });
        Schema::table('staff', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });
        Schema::table('nurses', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });
        Schema::table('pharmacists', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });
        Schema::table('administrators', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });
    }
}
