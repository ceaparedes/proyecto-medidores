<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medidores extends Model
{
    use HasFactory;

    protected $fillable = [
        'numero',
        'diametro',
        'ano',
        'estado',
        'tuerca',
        'varal',
        'fecha_registro',
        'marca_id',
        'usuario_id'
        
    ];

    public function marcas()
    {
        return $this->hasOne(Marcas::class, 'id', 'marca_id');
    }

    public function users()
    {
        return $this->hasOne(User::class, 'id', 'usuario_id');
    }
}
