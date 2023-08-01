<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clases', function (Blueprint $table) {
            //$table->id();
            $table->unsignedBigInteger('id')->nullable()->primary();
            $table->string('detclase');
            $table->string('slug');
            $table->unsignedBigInteger('familia_id')->nullable();
            $table->foreign('familia_id')->references('id')->on('familias')->onDelete('set null');
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
        Schema::dropIfExists('clases');
    }
}
