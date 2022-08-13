<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdenesDeTrabajosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordenes_de_trabajos', function (Blueprint $table) {
            $table->id();
            $table->string('codigo', 20);
            $table->date('fecha_asignada');
            $table->date('fecha_cambio');
            $table->date('fecha_cambio_1');
            $table->date('fecha_cambio_2');
            $table->string('servicio', 32);
            $table->string('ruta', 32);
            $table->string('nombre_cliente');
            $table->string('rut_cliente', 15);
            $table->string('direccion_cliente');
            $table->string('medidor_actual_serie', 32); 
            $table->string('medidor_actual_diametro', 10);
            $table->integer('medidor_actual_ano');
            $table->string('medidor_actual_lectura', 32);
            $table->string('medidor_actual_lectura_retiro', 32);
            $table->string('medidor_actual_codigo', 50);
            $table->string('medidor_nuevo_numero_serie', 32);
            $table->string('medidor_nuevo_diametro', 10);
            $table->integer('medidor_nuevo_ano');
            $table->string('varales', 32);
            $table->longText('observacion');
            $table->string('rut_persona_receptora', 15);
            $table->string('nombre_persona_receptora');
            $table->string('numero_contacto');
            $table->boolean('estado');
            $table->string('improcedencia');
            $table->string('imagen_1');
            $table->string('imagen_2');
            $table->string('imagen_3');
            $table->string('imagen_4');
            $table->integer('consumo');
            $table->string('segmento', 20);
            $table->string('tipo_listado', 50);
            $table->unsignedBigInteger('comuna_id');
            $table->unsignedBigInteger('usuario_id');
            $table->unsignedBigInteger('empresa_id');
            $table->unsignedBigInteger('medidor_id');
            $table->timestamps();

            $table->foreign('comuna_id')->references('id')->on('comunas');
            $table->foreign('usuario_id')->references('id')->on('users');
            $table->foreign('empresa_id')->references('id')->on('empresas');
            $table->foreign('medidor_id')->references('id')->on('medidores');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ordenes_de_trabajos');
    }
}
