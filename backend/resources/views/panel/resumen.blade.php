@extends('layouts.app')

@section('title', 'Resumen del análisis')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/panel.css') }}">
@endpush

@section('content')

@php
  $eeg = $sesion && $sesion['datos_eeg'] ? json_decode($sesion['datos_eeg'], true) : [];
  $ondas = [
    'delta'     => ['Delta',   '#ef4444', '0.5–4 Hz'],
    'theta'     => ['Theta',   '#f59e0b', '4–8 Hz'],
    'lowAlpha'  => ['Alpha L', '#3b82f6', '8–10 Hz'],
    'highAlpha' => ['Alpha H', '#60a5fa', '10–12 Hz'],
    'lowBeta'   => ['Beta L',  '#22c55e', '12–21 Hz'],
    'highBeta'  => ['Beta H',  '#84cc16', '21–30 Hz'],
    'lowGamma'  => ['Gamma',   '#a855f7', '30–50 Hz'],
  ];
@endphp

<div style="max-width:900px; margin:30px auto; padding:0 20px">

  {{-- Cabecera --}}
  <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:24px">
    <div>
      <h2 style="margin:0">Resumen del análisis</h2>
      @if ($paciente)
        <p style="margin:4px 0 0; color:#6b7280">
          {{ $paciente['nombre'] . ' ' . $paciente['apellido1'] . ' ' . $paciente['apellido2'] }}
          · {{ date('d/m/Y H:i', strtotime($sesion['fecha_hora_inicio'])) }}
          · {{ $sesion['duracion'] }}
        </p>
      @endif
    </div>
    <a href="{{ url('/panel') }}" style="text-decoration:none">
      <button class="btn-analisis btn-cancelar">← Volver</button>
    </a>
  </div>

  {{-- Grid de ondas --}}
  <div style="display:grid; grid-template-columns:repeat(auto-fill,minmax(260px,1fr)); gap:16px; margin-bottom:24px">
    @foreach ($ondas as $key => [$label, $color, $desc])
      @if (empty($eeg[$key])) @continue @endif
      @php $s = $eeg[$key]; @endphp
      <div style="background:#fff; border-radius:12px; box-shadow:0 2px 12px rgba(0,0,0,0.08); overflow:hidden">
        <div style="padding:14px 16px; background:#f9fafb; border-left:4px solid {{ $color }}; border-bottom:1px solid #e5e7eb">
          <div style="font-weight:700; color:{{ $color }}">{{ $label }}</div>
          <div style="font-size:0.75rem; color:#6b7280">{{ $desc }}</div>
          <div style="font-size:0.72rem; color:#9ca3af">{{ $s['muestras'] }} muestras</div>
        </div>
        <div style="display:grid; grid-template-columns:1fr 1fr; gap:10px; padding:14px 16px">
          @foreach ([
            'Máximo'       => $s['max'],
            'Mínimo'       => $s['min'],
            'Media'        => $s['media'],
            'Mediana'      => $s['mediana'],
            'Desv. típica' => $s['desv'],
            'Percentil 25' => $s['p25'],
            'Percentil 75' => $s['p75'],
          ] as $lbl => $val)
          <div>
            <div style="font-size:0.7rem; color:#9ca3af; text-transform:uppercase">{{ $lbl }}</div>
            <div style="font-size:1.05rem; font-weight:700; color:#111">{{ number_format($val, 2) }} Hz</div>
          </div>
          @endforeach
        </div>
      </div>
    @endforeach
  </div>

  {{-- Notas médicas --}}
  <div style="background:#fff; border-radius:12px; box-shadow:0 2px 12px rgba(0,0,0,0.08); padding:20px">
    <div style="font-size:0.78rem; color:#9ca3af; text-transform:uppercase; margin-bottom:8px">Notas médicas</div>
    <p style="margin:0; color:#374151; white-space:pre-wrap">{{ $sesion['notas_medicas'] ?? 'Sin notas.' }}</p>
  </div>

</div>

@endsection