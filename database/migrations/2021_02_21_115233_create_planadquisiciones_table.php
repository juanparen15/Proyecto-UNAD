<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanadquisicionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('planadquisiciones', function (Blueprint $table) {
            $table->id();
            $table->longText('descripcioncont');
            $table->string('valorestimadocont');
            $table->string('valorestimadovig');
            $table->string('duracont');
            $table->string('codbpim');
            $table->unsignedBigInteger('area_id')->nullable();
            $table->unsignedBigInteger('vigenfutura_id')->nullable();
            $table->unsignedBigInteger('tipozona_id')->nullable();
            $table->unsignedBigInteger('estadovigencia_id')->nullable();
            $table->unsignedBigInteger('modalidade_id')->nullable();
            $table->unsignedBigInteger('tipoproceso_id')->nullable();
            $table->unsignedBigInteger('tipoadquisicione_id')->nullable();
            $table->unsignedBigInteger('requiproyecto_id')->nullable();
            $table->unsignedBigInteger('fuente_id')->nullable();
            $table->unsignedBigInteger('tipoprioridade_id')->nullable();
            $table->unsignedBigInteger('mese_id')->nullable();
            $table->unsignedBigInteger('requipoai_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
           // $table->unsignedBigInteger('detplanadquisicione_id')->nullable();
            
            $table->string('slug');

            $table->foreign('area_id')->references('id')->on('areas')->onDelete('set null');
            $table->foreign('vigenfutura_id')->references('id')->on('vigenfuturas')->onDelete('set null');
            $table->foreign('tipozona_id')->references('id')->on('tipozonas')->onDelete('set null');
            $table->foreign('estadovigencia_id')->references('id')->on('estadovigencias')->onDelete('set null');
            $table->foreign('modalidade_id')->references('id')->on('modalidades')->onDelete('set null');
            $table->foreign('tipoproceso_id')->references('id')->on('tipoprocesos')->onDelete('set null');
            $table->foreign('tipoadquisicione_id')->references('id')->on('tipoadquisiciones')->onDelete('set null');
            $table->foreign('requiproyecto_id')->references('id')->on('requiproyectos')->onDelete('set null');
            $table->foreign('fuente_id')->references('id')->on('fuentes')->onDelete('set null');
            $table->foreign('tipoprioridade_id')->references('id')->on('tipoprioridades')->onDelete('set null');
            $table->foreign('mese_id')->references('id')->on('meses')->onDelete('set null');
            $table->foreign('requipoai_id')->references('id')->on('requipoais')->onDelete('set null');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
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
        Schema::dropIfExists('planadquisiciones');
    }
}
