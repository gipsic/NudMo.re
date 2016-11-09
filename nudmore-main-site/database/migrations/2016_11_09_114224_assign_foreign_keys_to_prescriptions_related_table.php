<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AssignForeignKeysToPrescriptionsRelatedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('prescriptions', function (Blueprint $table) {
            $table->foreign('patient_number')->references('patient_number')->on('patients')->onDelete('cascade');
        });
        Schema::table('dispenses', function (Blueprint $table) {
            $table->foreign('prescription_id')->references('id')->on('prescriptions')->onDelete('cascade');
            $table->foreign('medicine_id')->references('id')->on('medicines')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('prescriptions', function (Blueprint $table) {
            $table->dropForeign(['patient_number']);
        });
        Schema::table('dispenses', function (Blueprint $table) {
            $table->dropForeign(['prescription_id']);
            $table->dropForeign(['medicine_id']);
        });
    }
}
