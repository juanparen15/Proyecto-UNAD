<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            //$table->id();
            $table->unsignedBigInteger('id')->nullable()->primary();
            $table->string('detproducto');
            $table->string('slug');
            $table->unsignedBigInteger('clase_id')->nullable();
            $table->foreign('clase_id')->references('id')->on('clases')->onDelete('set null');
           // $table->unsignedBigInteger('detplanadquisicione_id')->nullable();
            //$table->foreign('detplanadquisicione_id')->references('id')->on('detplanadquisiciones')->onDelete('set null');
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
        Schema::dropIfExists('productos');
    }
}
