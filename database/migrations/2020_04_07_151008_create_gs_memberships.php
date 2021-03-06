<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGsMemberships extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gs_memberships', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('member_id');
            $table->foreign('member_id')->references('id')->on('Members');

            $table->string('formula_id');
            $table->foreign('formula_id')->references('formula_id')->on('formulas');

            $table->unsignedBigInteger('variable_id');
            $table->foreign('variable_id')->references('id')->on('variables');
            $table->decimal('content', 13, 2);
//testing ------------------------------------------------------
            $table->unsignedBigInteger('content_id');
            $table->foreign('content_id')->references('id')->on('memberships');
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
        Schema::dropIfExists('gs_memberships');
    }
}


