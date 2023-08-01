<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFamiliasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('familias', function (Blueprint $table) {
            //$table->id();
            $table->unsignedBigInteger('id')->nullable()->primary();
            $table->string('detfamilia');            
            $table->string('slug');
            $table->unsignedBigInteger('segmento_id')->nullable();
            $table->foreign('segmento_id')->references('id')->on('segmentos')->onDelete('set null');
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
        Schema::dropIfExists('familias');
    }
}
