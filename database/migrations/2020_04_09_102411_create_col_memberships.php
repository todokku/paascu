<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateColMemberships extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('col_memberships', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('member_id');
            $table->foreign('member_id')->references('id')->on('Members');

            $table->string('formula_id');
            $table->foreign('formula_id')->references('formula_id')->on('formulas');

            $table->unsignedBigInteger('variable_id');
            $table->foreign('variable_id')->references('id')->on('variables');
            $table->decimal('content', 13, 2);

            $table->unsignedBigInteger('content_id');
            $table->foreign('content_id')->references('id')->on('memberships');
            
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
        Schema::dropIfExists('col_memberships');
    }
}
