<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Hospital extends Model
{
    use HasFactory;

    protected $table      = 'hospitales';
    protected $primaryKey = 'hospitalID';

    protected $fillable = [
        'nombre',
        'ubicacion',
    ];

    // Relación inversa
    public function usuarios()
    {
        return $this->hasMany(UsuarioMedico::class, 'hospitalID', 'hospitalID');
    }

    public static function paraSelector()
    {
        return self::select('hospitalID', 'nombre')->get();
    }
}