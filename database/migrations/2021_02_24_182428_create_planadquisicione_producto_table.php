<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanadquisicioneProductoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('planadquisicione_producto', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('producto_id')->nullable();
            $table->unsignedBigInteger('planadquisicione_id')->nullable();            
            $table->foreign('producto_id')->references('id')->on('productos')->onDelete('set null');
            $table->foreign('planadquisicione_id')->references('id')->on('planadquisiciones')->onDelete('set null');

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
        Schema::dropIfExists('planadquisicione_producto');
    }
}
