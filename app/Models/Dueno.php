<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dueno extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'duenos';
    protected $primaryKey = 'idDueno';
    
    protected $fillable = [
        'nombre',
        'idMascota',
        'celular',
        'direccion',
        'correo',
        'ciudad'
    ];

    /**
     * Obtiene la mascota asociada al dueño.
     */
    public function mascota()
    {
        return $this->belongsTo(Mascota::class, 'idMascota', 'idMascota');
    }
}