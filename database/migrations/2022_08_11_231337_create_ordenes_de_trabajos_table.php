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
            $table->string('codigo', 20)->nullable();
            $table->date('fecha_asignada')->nullable();
            $table->date('fecha_cambio')->nullable();
            $table->date('fecha_cambio_1')->nullable();
            $table->date('fecha_cambio_2')->nullable();
            $table->string('servicio', 32);
            $table->string('ruta');
            $table->string('nombre_cliente');
            $table->string('rut_cliente', 15)->nullable();
            $table->string('direccion_cliente');
            //Medidor actual
            $table->string('medidor_actual_serie', 32)->nullable(); 
            $table->string('medidor_actual_diametro', 10)->nullable();
            $table->integer('medidor_actual_ano')->nullable();
            $table->string('medidor_actual_volumen_total', 32)->nullable();
            $table->string('medidor_actual_lectura_retiro', 32)->nullable();
            $table->string('medidor_actual_rango_m3')->nullable();
            $table->integer('medidor_actual_rango_minimo')->nullable();
            $table->integer('medidor_actual_rango_maximo')->nullable();
            $table->string('medidor_actual_tecnologia')->nullable();
            $table->string('medidor_actual_clase_metroilogica', 10)->nullable();
            $table->string('medidor_actual_rango_medicion', 10)->nullable();
            $table->string('medidor_actual_fabricante')->nullable();
            $table->string('medidor_anterior_modelo')->nullable();
            $table->string('medidor_actual_dispositivo_deteccion_fugas')->nullable();
            //Medidor Nuevo
            $table->string('medidor_nuevo_numero_serie', 32)->nullable();
            $table->string('medidor_nuevo_diametro', 10)->nullable();
            $table->integer('medidor_nuevo_ano')->nullable();
            $table->string('varales', 32)->nullable();
            $table->longText('observacion')->nullable();
            $table->string('rut_persona_receptora', 15)->nullable();
            $table->string('nombre_persona_receptora')->nullable();
            $table->string('numero_contacto')->nullable();
            $table->boolean('estado')->nullable();
            $table->string('improcedencia')->nullable();
            $table->string('imagen_1')->nullable();
            $table->string('imagen_2')->nullable();
            $table->string('imagen_3')->nullable();
            $table->string('imagen_4')->nullable();
            $table->integer('consumo')->nullable();
            $table->string('segmento', 20)->nullable();
            $table->string('tipo_listado', 50)->nullable();
            $table->unsignedBigInteger('comuna_id')->nullable();
            $table->unsignedBigInteger('usuario_id')->nullable();
            $table->unsignedBigInteger('empresa_id')->nullable();
            $table->unsignedBigInteger('medidor_id')->nullable();
            $table->timestamps();

            $table->foreign('comuna_id')->references('id')->on('comunas');
            $table->foreign('usuario_id')->references('id')->on('users')->nullable();
            $table->foreign('empresa_id')->references('id')->on('empresas')->nullable();
            $table->foreign('medidor_id')->references('id')->on('medidores')->nullable();
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
