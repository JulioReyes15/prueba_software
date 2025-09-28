<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    use HasFactory;

    protected $table='equipos';
    protected $primaryKey= 'id_equipo';

    protected $fillable = [
        'id_cliente',
        'id_marca',
        'tipo_equipo',
        'modelo',
    ];

      public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'id_cliente');
    }

    public function marca()
    {
        return $this->belongsTo(Marca::class, 'id_marca');
    }
}
