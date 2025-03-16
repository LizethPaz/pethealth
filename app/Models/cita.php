<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cita extends Model
{
    use HasFactory,SoftDeletes;
    
    protected $primaryKey = 'idCita';
    
    protected $fillable = [
        'fecha',
        'idDueno',
        'idMascota',
        'tipoCita',
        'idVete',
        'observaciones'
        
    ];
    
    // Relación con el dueño
    public function dueno()
    {
        return $this->belongsTo(Dueno::class, 'idDueno');
    }
    
    // Relación con la mascota
    public function mascota()
    {
        return $this->belongsTo(Mascota::class, 'idMascota');
    }
    // En el modelo Cita.php
public function veterinario()
{
    return $this->belongsTo(Veterinario::class, 'idVete', 'idVete');
}
}