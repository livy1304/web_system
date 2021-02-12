<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Officers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('officers', function (Blueprint $table) {
            $table->bigIncrements('OfficerId');
            $table->string("OfficerName");
            $table->string("OfficerUserName");
            $table->string("HospitalId");
            $table->string("HospitalCategory")->default("general");
            $table->string("OfficerRole")->default('officer');
            $table->string("Payments")->default("0");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('officers');
    }
}
