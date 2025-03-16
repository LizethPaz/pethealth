<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mascota extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'mascotas';
    protected $primaryKey = 'idMascota';
    
    protected $fillable = [
        'nomMascota',
        'edadMascota',
        'colorMascota',
        'tipoMascota'
    ];

        /**
     * Obtiene los dueños asociados a esta mascota.
     */
    public function duenos()
    {
        return $this->hasMany(Dueno::class, 'idMascota', 'id');
    }
}