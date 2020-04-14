<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnrolledAcpagps extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enrolled_acpagps', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('compute_id');
            $table->foreign('compute_id')->references('id')->on('computes')->onDelete('cascade');   
            $table->string('program');
            $table->string('ap_type');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('enrolled_acpagps');
    }
}
