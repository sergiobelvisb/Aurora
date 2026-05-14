<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PrincipalController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegistroController;
use App\Http\Controllers\PanelControlController;
use App\Http\Controllers\PanelController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\AdminUsuariosController;

// ══════════════════════════════════════════════════════════════
// RUTAS PÚBLICAS — sin autenticación
// ══════════════════════════════════════════════════════════════

Route::get('/', [PrincipalController::class, 'index'])->name('home');
Route::get('/tecnologia', [PrincipalController::class, 'tecnologia'])->name('tecnologia');
Route::get('/profesionales', [PrincipalController::class, 'profesionales'])->name('profesionales');

// ── LOGIN ──────────────────────────────────────────────────────
Route::get('/login',  [LoginController::class, 'index'])->name('login.form');
Route::post('/login', [LoginController::class, 'autenticar'])->name('login.post');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

// ── REGISTRO ───────────────────────────────────────────────────
Route::get('/registro',  [RegistroController::class, 'index'])->name('registro.form');
Route::post('/registro', [RegistroController::class, 'registrar'])->name('registro.post');


// ══════════════════════════════════════════════════════════════
// RUTAS PROTEGIDAS — requieren sesión activa (middleware AuthAurora)
// ══════════════════════════════════════════════════════════════

Route::middleware('auth.aurora')->group(function () {

    // ── PANEL CONTROL (existente) ──────────────────────────────
    Route::get('/panel-control', [PanelController::class, 'index'])
         ->name('panel-control.index');
    Route::post('/panel-control/paciente', [PanelController::class, 'registrarPaciente'])
         ->name('panel-control.registrar-paciente');

    // ── PANEL EEG (nuevo) ──────────────────────────────────────
    Route::prefix('panel')->name('panel.')->group(function () {

        // Vistas
        Route::get('/',        [PanelController::class, 'index'])  ->name('index');
        Route::get('/resumen', [PanelController::class, 'resumen'])->name('resumen');

        // Acciones JSON (POST)
        Route::post('/guardarSesion',    [PanelController::class, 'guardarSesion'])   ->name('guardarSesion');
        Route::post('/eliminarSesion',   [PanelController::class, 'eliminarSesion'])  ->name('eliminarSesion');
        Route::post('/crearPaciente',    [PanelController::class, 'crearPaciente'])   ->name('crearPaciente');
        Route::post('/editarPaciente',   [PanelController::class, 'editarPaciente'])  ->name('editarPaciente');
        Route::post('/eliminarPaciente', [PanelController::class, 'eliminarPaciente'])->name('eliminarPaciente');

    });

    // ── PERFIL ─────────────────────────────────────────────────
    Route::get('/perfil',            [PerfilController::class, 'show'])       ->name('perfil.show');
    Route::post('/perfil/foto',      [PerfilController::class, 'cambiarFoto'])->name('perfil.cambiar-foto');
    Route::get('/perfil/configurar', [PerfilController::class, 'configurar']) ->name('perfil.configurar');
    Route::patch('/perfil',          [PerfilController::class, 'actualizar']) ->name('perfil.actualizar');

    // Campos individuales del perfil (modales)
    Route::patch('/perfil/nombre',   [PerfilController::class, 'actualizarNombre'])  ->name('perfil.nombre');
    Route::patch('/perfil/email',    [PerfilController::class, 'actualizarEmail'])   ->name('perfil.email');
    Route::patch('/perfil/password', [PerfilController::class, 'actualizarPassword'])->name('perfil.password');
    Route::patch('/perfil/hospital', [PerfilController::class, 'actualizarHospital'])->name('perfil.hospital');

    // ── ADMIN — solo rol administrador ─────────────────────────
    Route::middleware('acl.admin')->group(function () {
        Route::get('/vistas-administrador',  [AdminUsuariosController::class, 'dashboard'])
             ->name('admin.dashboard');
        Route::get('/admin/usuarios',        [AdminUsuariosController::class, 'index'])
             ->name('admin.usuarios.index');
        Route::get('/admin/usuarios/{id}',   [AdminUsuariosController::class, 'show'])
             ->name('admin.usuarios.show');
        Route::patch('/admin/usuarios/{id}', [AdminUsuariosController::class, 'actualizar'])
             ->name('admin.usuarios.actualizar');
    });

});