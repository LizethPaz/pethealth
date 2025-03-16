<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Veterinario extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $table = 'veterinarios';
    protected $primaryKey = 'idVete';
    
    protected $fillable = [
        'nombreVete',
        'correo',
        'especialidad',
        'telefono'
    ];
    
    // Relación con las citas
    public function citas()
    {
        return $this->hasMany(Cita::class, 'idVete', 'idVete');
    }
}