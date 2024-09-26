<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class empleado extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nombres',
        'apellidos',
        'identificacion',
        'direccion',
        'telefono',
        'ciudad_id',
        'jefe_id'
    ];

    public function cargos()
    {
        return $this->belongsToMany(Cargo::class);
    }

    public function jefe()
    {
        return $this->belongsTo(Empleado::class, 'jefe_id');
    }
    
    public function ciudad()
    {
        return $this->belongsTo(Ciudad::class, 'ciudad_id');
    }

    public function colaboradores()
    {
        return $this->hasMany(Empleado::class, 'jefe_id');
    }

    public function esPresidente()
    {
        // Suponiendo que la identificación del presidente es un valor único.
        return $this->identificacion === 11; // Cambia 'PRESIDENTE_ID' por el ID real del presidente
    }
}
