<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Hospital extends Model
{
    use HasFactory;

    protected $table      = 'hospitales';
    protected $primaryKey = 'hospitalID';

    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'ubicacion',
    ];

    // Relaciones 

    public function usuarios()
    {
        return $this->hasMany(Usuario::class, 'hospitalID', 'hospitalID');
    }

    // Metodos de consulta

    /**
     * Devuelve todos los hospitales ordenados por nombre, solo con los campos
     * necesarios para los selects de formulario.
     */
    public static function paraSelector(): \Illuminate\Database\Eloquent\Collection
    {
        return static::select('hospitalID', 'nombre', 'ubicacion')
            ->orderBy('nombre')
            ->get();
    }
}