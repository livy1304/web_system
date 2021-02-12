<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Hospitals extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('hospitals', function (Blueprint $table) {
            $table->bigIncrements('HospitalId');
            $table->string("HospitalName");
            $table->string("HospitalCategory");
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
        Schema::dropIfExists('hospitals');
    }
}
