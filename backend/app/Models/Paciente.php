<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    protected $table      = 'pacientes';
    protected $primaryKey = 'pacienteID';

    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'apellido1',
        'apellido2',
        'telefono',
        'fecha_de_nacimiento',
        'direccion',
        'userID',
    ];

    // Relaciones 

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'userID', 'userID');
    }

    public function sesiones()
    {
        return $this->hasMany(Sesion::class, 'pacienteID', 'pacienteID');
    }

    // Scopes 

    public function scopeDelUsuario($query, int $userID)
    {
        return $query->where('userID', $userID);
    }

    // Metodos de consulta 

    /**
     * Devuelve todos los pacientes de un médico con sus sesiones ordenadas.
     */
    public static function conSesionesDelUsuario(int $userID): \Illuminate\Database\Eloquent\Collection
    {
        return static::delUsuario($userID)
            ->with(['sesiones' => fn($q) => $q->orderByDesc('fecha_hora_inicio')])
            ->get();
    }
}