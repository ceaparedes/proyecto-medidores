<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdenesDeTrabajo extends Model
{
    use HasFactory;

    protected $fillable = [
        'servicio' ,
        'ruta' ,
        'nombre_cliente'  ,
        'direccion_cliente' ,
        'comuna_id',
        'medidor_actual_serie',
        'medidor_actual_ano',
        'medidor_actual_volumen_total',
        'medidor_actual_rango_m3',
        'medidor_actual_rango_m3_250',
        'medidor_actual_rango_minimo',
        'medidor_actual_rango_maximo',
        'medidor_actual_tecnologia',
        'medidor_actual_clase_metroilogica',
        'medidor_actual_rango_medicion',
        'medidor_actual_fabricante',
        'medidor_anterior_modelo',
        'medidor_actual_dispositivo_deteccion_fugas',
        'medidor_actual_diametro',
        'estado'
    ];

    protected $dates = ['fecha_asignada', 'fecha_cambio', 'fecha_cambio_1', 'fecha_cambio_2'];

    public function comunas(){
        return $this->hasOne(Comunas::class, 'id', 'comuna_id');
    }

    public function users(){
        return $this->hasOne(User::class, 'id', 'usuario_id');
    }

    public function empresas(){
        return $this->hasOne(Empresas::class, 'id', 'empresa_id');
    }

    public function medidores(){
        return $this->hasOne(Medidores::class, 'id', 'medidor_id');
    }
}
