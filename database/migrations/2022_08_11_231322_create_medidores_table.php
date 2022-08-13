<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedidoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medidores', function (Blueprint $table) {
            $table->id();
            $table->string('numero', 20);
            $table->string('diametro', 10);
            $table->integer('ano');
            $table->integer('tuerca');
            $table->string('varal', 32);
            $table->boolean('estado');
            $table->unsignedBigInteger('marca_id');
            $table->unsignedBigInteger('usuario_id');
            $table->date('fecha_registro');
            $table->timestamps();

            $table->foreign('marca_id')->references('id')->on('marcas');
            $table->foreign('usuario_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('medidores');
    }
}
