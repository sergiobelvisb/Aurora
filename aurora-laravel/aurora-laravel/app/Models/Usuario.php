<?php
// app/Models/Usuario.php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;

class Usuario extends Authenticatable
{
    protected $table      = 'usuarios_medicos';
    protected $primaryKey = 'userID';

    protected $fillable = [
        'username', 'nombre', 'email', 'password', 'hospitalID', 'fotodeperfil', 'acl'
    ];

    protected $hidden = ['password'];

    // ──────────────────────────────────────────────
    // Relaciones
    // ──────────────────────────────────────────────

    // Tu: getHospital($id) con JOIN manual
    public function hospital()
    {
        return $this->belongsTo(Hospital::class, 'hospitalID');
        // Uso: $usuario->hospital->nombre
    }

    public function pacientes()
    {
        return $this->hasMany(Paciente::class, 'medicoID');
        //  getPacientesByMedico($medicoID)
    }

    // ──────────────────────────────────────────────
    // Métodos de negocio (los que no cubre Eloquent)
    // ──────────────────────────────────────────────

    //  comprobarUsuario($email, $password)
    public static function verificarCredenciales(string $email, string $password): bool
    {
        $usuario = static::where('email', $email)->first();
        if (!$usuario) return false;
        return Hash::check($password, $usuario->password);
    }

    // cambiarFoto($id, $foto) — la lógica de ficheros va al Controller o un Service
    public function actualizarFotoPerfil(string $nombreArchivo): bool
    {
        $this->fotodeperfil = $nombreArchivo;
        return $this->save();
    }

    // cambiarPassword($id, $current, $new)
    public function cambiarPassword(string $actual, string $nueva): bool
    {
        if (!Hash::check($actual, $this->password)) return false;
        $this->password = Hash::make($nueva);
        return $this->save();
    }

    // existeEmail / existeUsername
    public static function existeEmail(string $email): bool
    {
        return static::where('email', $email)->exists();
    }

    public static function existeUsername(string $username): bool
    {
        return static::where('username', $username)->exists();
    }
}
