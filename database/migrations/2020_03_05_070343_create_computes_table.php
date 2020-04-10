<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComputesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('computes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('member_id');
            $table->foreign('member_id')->references('id')->on('Members');

            $table->decimal('gtr', 13, 2);
            $table->decimal('amf', 13, 2);
            $table->string('formula_id');
  
            $table->string('status')->default("active");
//testing ------------------------------------------------------
            $table->unsignedBigInteger('content_id');
            $table->foreign('content_id')->references('id')->on('Memberships');
//testing ------------------------------------------------------
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
        Schema::dropIfExists('computes');
    }
}
