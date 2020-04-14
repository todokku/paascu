<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnrolledPrograms extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enrolled_programs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('compute_id');
            $table->foreign('compute_id')->references('id')->on('computes')->onDelete('cascade');
            $table->string('program');
            $table->decimal('semone', 13, 2);
            $table->decimal('semtwo', 13, 2);
            $table->decimal('semthree', 13, 2)->nullable();
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
        Schema::dropIfExists('enrolled_programs');
    }
}
