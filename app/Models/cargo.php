<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cargo extends Model
{
    use HasFactory;

    protected $fillable = ['nombre'];

    public function empleados()
    {
        return $this->belongsToMany(Empleado::class);
    }
}
