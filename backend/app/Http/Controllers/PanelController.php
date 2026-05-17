<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use App\Models\Sesion;
use Illuminate\Http\Request;

class PanelController extends Controller
{

    public function index()
    {
        $pacientes = Paciente::conSesionesDelUsuario(session('userID'));
        return view('panel.index', compact('pacientes'));
    }

    // Vista de resumen de una sesion 

    public function resumen($pacienteID, $sesionID)
    {
        $sesion = Sesion::with('paciente')->findOrFail($sesionID);

        if ($sesion->pacienteID != $pacienteID) {
            abort(403, 'Acceso no permitido');
        }

        $paciente = $sesion->paciente;

        return view('panel.resumen', compact('sesion', 'paciente'));
    }

    // Guardar sesion EEG 

    public function guardarSesion(Request $request)
    {
        $sesion = Sesion::create([
            'userID'            => session('userID'),
            'pacienteID'        => $request->input('pacienteID'),
            'fecha_hora_inicio' => $request->input('fechaInicio'),
            'fecha_hora_fin'    => $request->input('fechaFin'),
            'duracion'          => $request->input('duracion'),
            'datos_eeg'         => $request->input('datosEeg'),
            'notas_medicas'     => $request->input('notas'),
        ]);

        return response()->json(['ok' => $sesion->exists]);
    }

    // Eliminar sesion
    public function eliminarSesion(Request $request)
    {
        $deleted = Sesion::where('sesionID', $request->input('sesionID'))->delete();
        return response()->json(['ok' => (bool) $deleted]);
    }

    // Crear paciente 

    public function crearPaciente(Request $request)
    {
        $paciente = Paciente::create([
            'nombre'              => $request->input('nombre'),
            'apellido1'           => $request->input('apellido1'),
            'apellido2'           => $request->input('apellido2'),
            'telefono'            => $request->input('telefono'),
            'fecha_de_nacimiento' => $request->input('fechaNacimiento'),
            'direccion'           => $request->input('direccion'),
            'userID'              => session('userID'),
        ]);

        return response()->json(['ok' => $paciente->exists]);
    }

    // Editar paciente 

    public function editarPaciente(Request $request)
    {
        $updated = Paciente::where('pacienteID', $request->input('pacienteID'))
            ->update([
                'nombre'              => $request->input('nombre'),
                'apellido1'           => $request->input('apellido1'),
                'apellido2'           => $request->input('apellido2'),
                'telefono'            => $request->input('telefono'),
                'fecha_de_nacimiento' => $request->input('fechaNacimiento'),
                'direccion'           => $request->input('direccion'),
            ]);

        return response()->json(['ok' => (bool) $updated]);
    }

    // Eliminar paciente 

    public function eliminarPaciente(Request $request)
    {
        $deleted = Paciente::where('pacienteID', $request->input('pacienteID'))->delete();
        return response()->json(['ok' => (bool) $deleted]);
    }
}