<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    use HasFactory;

    protected $table='servicios';
    protected $primaryKey='id_servicio';

    protected $fillable = [
        'id_equipo',
        'id_tecnico',
        'fecha_recepcion',
        'problema_reportado',
        'estado',
        'diagnostico',
        'solucion',
        'fecha_entrega',
    ];

    public function equipo()
    {
        return $this->belongsTo(Equipo::class, 'id_equipo', 'id_equipo');
    }

    public function tecnico()
    {
        return $this->belongsTo(Tecnico::class, 'id_tecnico', 'id_tecnico');
    }

}
