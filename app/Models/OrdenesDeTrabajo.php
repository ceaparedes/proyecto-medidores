<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdenesDeTrabajo extends Model
{
    use HasFactory;

    protected $fillable = [
        'codigo',
        'servicio',
        'ruta',
        'nombre_cliente',
        'comuna_id',
        'direccion_cliente',
        'estado'
    ];


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
