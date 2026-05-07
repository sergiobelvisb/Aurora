<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UsuarioMedico extends Authenticatable
{
    use HasFactory;

    protected $table      = 'usuarios_medicos';
    protected $primaryKey = 'userID';

    protected $fillable = [
        'username',
        'nombre',
        'apellido1',
        'apellido2',
        'email',
        'password',
        'acl',
        'hospitalID',
    ];

    protected $hidden = [
        'password',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    // Relación con Hospital
    public function hospital()
    {
        return $this->belongsTo(Hospital::class, 'hospitalID', 'hospitalID');
    }
}