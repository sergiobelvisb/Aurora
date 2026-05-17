<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;

class Usuario extends Authenticatable
{
    protected $table      = 'usuarios_medicos';
    protected $primaryKey = 'userID';

    public $timestamps = false;

    protected $fillable = [
        'username',
        'nombre',
        'apellido1',
        'apellido2',
        'email',
        'password',
        'acl',
        'hospitalID',
        'fotodeperfil',
    ];

    protected $hidden = ['password'];

    // Relaciones 

    public function hospital()
    {
        return $this->belongsTo(Hospital::class, 'hospitalID', 'hospitalID');
    }

    public function pacientes()
    {
        return $this->hasMany(Paciente::class, 'userID', 'userID');
    }

    // Scopes 

    public function scopeMedicos($query)
    {
        return $query->where('acl', 'Medico');
    }

    public function scopeAdministradores($query)
    {
        return $query->where('acl', 'Administrador');
    }

    public function scopeRecientes($query, int $limit = 5)
    {
        return $query->orderByDesc('userID')->limit($limit);
    }

    // Métodos de negocio 

    public function esAdministrador(): bool
    {
        return $this->acl === 'Administrador';
    }

    /**
     * Verifica las credenciales y devuelve el usuario o null.
     */
    public static function autenticar(string $email, string $password): ?static
    {
        $usuario = static::where('email', $email)->first();

        if (!$usuario || !Hash::check($password, $usuario->password)) {
            return null;
        }

        return $usuario;
    }

    /**
     * Datos de sesión listos para guardar en session([...]).
     */
    public function datosDeSesion(): array
    {
        return [
            'userID'         => $this->userID,
            'username'       => $this->username,
            'nombreCompleto' => $this->nombre,
            'foto'           => '/img/pfp/' . $this->fotodeperfil,
            'acl'            => $this->acl,
        ];
    }

    /**
     * Actualiza la foto de perfil y devuelve el nombre del archivo guardado.
     */
    public function actualizarFoto(\Illuminate\Http\UploadedFile $archivo): string
    {
        $nombreFoto = $this->userID . '_' . time() . '.jpg';
        $archivo->move(public_path('img/pfp'), $nombreFoto);
        $this->fotodeperfil = $nombreFoto;
        $this->save();

        return $nombreFoto;
    }

    /**
     * Actualiza la contraseña hasheada.
     */
    public function actualizarPassword(string $nuevaPassword): void
    {
        $this->password = Hash::make($nuevaPassword);
        $this->save();
    }
}