<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AssignForeignKeysToNotificationsRelatedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('email_notifications', function (Blueprint $table) {
            $table->integer('notification_id')->length(10)->unsigned()->change();
            $table->foreign('notification_id')->references('id')->on('notifications')->onDelete('cascade');
        });
        Schema::table('sms_notifications', function (Blueprint $table) {
            $table->integer('notification_id')->length(10)->unsigned()->change();
            $table->foreign('notification_id')->references('id')->on('notifications')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('email_notifications', function (Blueprint $table) {
            $table->dropForeign(['notification_id']);
        });
        Schema::table('sms_notifications', function (Blueprint $table) {
            $table->dropForeign(['notification_id']);
        });
    }
}
