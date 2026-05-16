<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sesion extends Model
{
    protected $table      = 'sesiones';
    protected $primaryKey = 'sesionID';

    public $timestamps = false;

    protected $fillable = [
        'userID',
        'pacienteID',
        'fecha_hora_inicio',
        'fecha_hora_fin',
        'duracion',
        'datos_eeg',
        'notas_medicas',
    ];

    // Relaciones 

    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'pacienteID', 'pacienteID');
    }

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'userID', 'userID');
    }
}