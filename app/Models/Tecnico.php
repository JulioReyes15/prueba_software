<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tecnico extends Model
{
    use HasFactory;

    protected $table='tecnicos';
    protected $primaryKey='id_tecnico'; 

     protected $fillable = [
        'nombre',
        'apellido',
        'especialidad',
        'telefono',
        'email',
    ];

    public function servicios()
    {
        return $this->hasMany(Servicio::class, 'id_tecnico', 'id_tecnico');
    }


}
