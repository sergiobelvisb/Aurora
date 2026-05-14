<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PanelController extends Controller
{

    // ── Vista principal: lista de pacientes ────────────────────────────────
    public function index()
    {
        $userID    = session('userID');
        $pacientes = DB::select('SELECT * FROM pacientes WHERE userID = ?', [$userID]);

        // Convertir a array y añadir sesiones a cada paciente
        $pacientes = array_map(function ($p) {
            $p = (array) $p;
            $p['sesiones'] = array_map(
                fn($s) => (array) $s,
                DB::select(
                    'SELECT * FROM sesiones WHERE pacienteID = ? ORDER BY fecha_hora_inicio DESC',
                    [$p['pacienteID']]
                )
            );
            return $p;
        }, $pacientes);

        return view('panel.index', compact('pacientes'));
    }

    // ── Vista de resumen de una sesión ─────────────────────────────────────
    public function resumen(Request $request)
    {
        $sesionID   = $request->query('sesionID');
        $pacienteID = $request->query('pacienteID');

        $sesion = DB::select('SELECT * FROM sesiones WHERE sesionID = ?', [$sesionID]);
        $sesion = $sesion ? (array) $sesion[0] : null;

        if (!$sesion) {
            abort(404, 'Sesión no encontrada');
        }

        if ($pacienteID && $sesion['pacienteID'] != $pacienteID) {
            abort(403, 'Acceso no permitido');
        }

        $paciente = DB::select('SELECT * FROM pacientes WHERE pacienteID = ?', [$sesion['pacienteID']]);
        $paciente = $paciente ? (array) $paciente[0] : null;

        return view('panel.resumen', compact('sesion', 'paciente'));
    }

    // ── Guardar sesión EEG ─────────────────────────────────────────────────
    public function guardarSesion(Request $request)
    {
        $userID = session('userID');

        $ok = DB::insert(
            'INSERT INTO sesiones (userID, pacienteID, fecha_hora_inicio, fecha_hora_fin, duracion, datos_eeg, notas_medicas)
             VALUES (?, ?, ?, ?, ?, ?, ?)',
            [
                $userID,
                $request->input('pacienteID'),
                $request->input('fechaInicio'),
                $request->input('fechaFin'),
                $request->input('duracion'),
                $request->input('datosEeg'),
                $request->input('notas'),
            ]
        );

        return response()->json(['ok' => (bool) $ok]);
    }

    // ── Eliminar sesión ────────────────────────────────────────────────────
    public function eliminarSesion(Request $request)
    {
        $ok = DB::delete('DELETE FROM sesiones WHERE sesionID = ?', [
            $request->input('sesionID'),
        ]);

        return response()->json(['ok' => (bool) $ok]);
    }

    // ── Crear paciente ─────────────────────────────────────────────────────
    public function crearPaciente(Request $request)
    {
        $userID = session('userID');

        $ok = DB::insert(
            'INSERT INTO pacientes (nombre, apellido1, apellido2, telefono, fecha_de_nacimiento, direccion, userID)
             VALUES (?, ?, ?, ?, ?, ?, ?)',
            [
                $request->input('nombre'),
                $request->input('apellido1'),
                $request->input('apellido2'),
                $request->input('telefono'),
                $request->input('fechaNacimiento'),
                $request->input('direccion'),
                $userID,
            ]
        );

        return response()->json(['ok' => (bool) $ok]);
    }

    // ── Editar paciente ────────────────────────────────────────────────────
    public function editarPaciente(Request $request)
    {
        $ok = DB::update(
            'UPDATE pacientes SET nombre=?, apellido1=?, apellido2=?, telefono=?, fecha_de_nacimiento=?, direccion=?
             WHERE pacienteID=?',
            [
                $request->input('nombre'),
                $request->input('apellido1'),
                $request->input('apellido2'),
                $request->input('telefono'),
                $request->input('fechaNacimiento'),
                $request->input('direccion'),
                $request->input('pacienteID'),
            ]
        );

        return response()->json(['ok' => (bool) $ok]);
    }

    // ── Eliminar paciente ──────────────────────────────────────────────────
    public function eliminarPaciente(Request $request)
    {
        $ok = DB::delete('DELETE FROM pacientes WHERE pacienteID = ?', [
            $request->input('pacienteID'),
        ]);

        return response()->json(['ok' => (bool) $ok]);
    }
}