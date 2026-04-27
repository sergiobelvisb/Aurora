<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PrincipalController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegistroController;
use App\Http\Controllers\PanelControlController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\AdminUsuariosController;

// ══════════════════════════════════════════════════════════════
// RUTAS PÚBLICAS — sin autenticación
// Tu .htaccess: ^([controller])$ → index.php?controller=$1
// ══════════════════════════════════════════════════════════════

// ViewPrincipal → Principal/index
Route::get('/', [PrincipalController::class, 'index'])->name('home');

// ViewTecnologia → Tecnologia/index
Route::get('/tecnologia', [PrincipalController::class, 'tecnologia'])->name('tecnologia');

// ViewProfesionales → Profesionales/index
Route::get('/profesionales', [PrincipalController::class, 'profesionales'])->name('profesionales');

// ── LOGIN ──────────────────────────────────────────────────────
// Tu: Controller=Login, action=index / action=comprobarSesion
Route::get('/login',  [LoginController::class, 'index'])->name('login.form');
Route::post('/login', [LoginController::class, 'autenticar'])->name('login.post');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

// ── REGISTRO ───────────────────────────────────────────────────
// Tu: Controller=Registro, action=index / action=registrarUsuario
Route::get('/registro',  [RegistroController::class, 'index'])->name('registro.form');
Route::post('/registro', [RegistroController::class, 'registrar'])->name('registro.post');


// ══════════════════════════════════════════════════════════════
// RUTAS PROTEGIDAS — requieren sesión activa
// Tu middleware manual: if(!session('userID')) redirect al login
// ══════════════════════════════════════════════════════════════

Route::middleware('auth.aurora')->group(function () {

    // ── PANEL DE CONTROL ───────────────────────────────────────
    // Tu: Controller=PanelControl, action=index / action=registrarPaciente
    Route::get('/panel-control',              [PanelControlController::class, 'index'])
         ->name('panel.index');
    Route::post('/panel-control/paciente',    [PanelControlController::class, 'registrarPaciente'])
         ->name('panel.registrar-paciente');

    // ── PERFIL ─────────────────────────────────────────────────
    // Tu: Controller=Perfil, action=index / cambiarFoto / ActualizarPerfil
    Route::get('/perfil',                     [PerfilController::class, 'show'])
         ->name('perfil.show');
    Route::post('/perfil/foto',               [PerfilController::class, 'cambiarFoto'])
         ->name('perfil.cambiar-foto');
    Route::get('/perfil/configurar',          [PerfilController::class, 'configurar'])
         ->name('perfil.configurar');
    Route::patch('/perfil',                   [PerfilController::class, 'actualizar'])
         ->name('perfil.actualizar');

    // Campos individuales del perfil (los modales)
    Route::patch('/perfil/nombre',            [PerfilController::class, 'actualizarNombre'])
         ->name('perfil.nombre');
    Route::patch('/perfil/email',             [PerfilController::class, 'actualizarEmail'])
         ->name('perfil.email');
    Route::patch('/perfil/password',          [PerfilController::class, 'actualizarPassword'])
         ->name('perfil.password');
    Route::patch('/perfil/hospital',          [PerfilController::class, 'actualizarHospital'])
         ->name('perfil.hospital');

    // ── ADMIN — solo rol administrador ─────────────────────────
    // Tu: Controller=VistasAdministrador / AdminUsuarios
    Route::middleware('acl.admin')->group(function () {
        Route::get('/vistas-administrador',           [AdminUsuariosController::class, 'dashboard'])
             ->name('admin.dashboard');

        // Tu: AdminUsuarios/index + AdminUsuarios/Usuario/{id}
        Route::get('/admin/usuarios',                 [AdminUsuariosController::class, 'index'])
             ->name('admin.usuarios.index');
        Route::get('/admin/usuarios/{id}',            [AdminUsuariosController::class, 'show'])
             ->name('admin.usuarios.show');
        Route::patch('/admin/usuarios/{id}',          [AdminUsuariosController::class, 'actualizar'])
             ->name('admin.usuarios.actualizar');
    });

});