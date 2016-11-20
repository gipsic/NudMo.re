<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyNecessaryTable4 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('records', function (Blueprint $table) {   
            $table->float('weight', 5, 2);
            $table->float('height', 5, 2);
            $table->float('temperature', 4, 2);
            $table->integer('heart_rate');
            $table->integer('systolic_blood_pressure');
            $table->integer('diastolic_blood_pressure');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('records', function (Blueprint $table) {
            $table->dropColumn('weight');
            $table->dropColumn('height');
            $table->dropColumn('temperature');
            $table->dropColumn('heart_rate');
            $table->dropColumn('systolic_blood_pressure');
            $table->dropColumn('diastolic_blood_pressure');
        });
    }
}
