@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/panel.css') }}">
<style>
  /* ── Contenedor principal ── */
  #pantalla-pacientes {
    max-width: 860px;
    margin: 36px auto;
    padding: 0 20px;
  }

  /* ── Cabecera ── */
  .pacientes-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 24px;
  }

  .pacientes-header h2 {
    margin: 0;
    font-size: 1.9rem;
    color: #111827;
  }

  /* ── Lista ── */
  .pacientes-lista {
    display: flex;
    flex-direction: column;
    gap: 10px;
  }

  /* ── Fila paciente ── */
  .paciente-item {
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 1px 6px rgba(0,0,0,0.08);
    overflow: hidden;
  }
  .paciente-row {
    display: flex;
    align-items: center;
    padding: 14px 16px;
    gap: 12px;
  }
  .paciente-info {
    display: flex;
    align-items: center;
    gap: 14px;
    flex: 1;
    cursor: pointer;
    min-width: 0;
  }
  .paciente-nombre {
    font-weight: 700;
    font-size: 0.97rem;
    color: #111827;
    white-space: nowrap;
  }
  .paciente-tel {
    font-size: 0.9rem;
    color: #6b7280;
    white-space: nowrap;
  }
  .paciente-arrow {
    font-size: 0.8rem;
    color: #9ca3af;
    transition: transform 0.2s;
  }
  .paciente-acciones {
    display: flex;
    align-items: center;
    gap: 8px;
    flex-shrink: 0;
  }

  /* ── Botones icono ── */
  .btn-icono {
    width: 34px !important;
    height: 34px !important;
    min-width: 0 !important;
    border-radius: 8px !important;
    border: 1px solid #e5e7eb !important;
    background: #fff !important;
    font-size: 1rem !important;
    cursor: pointer !important;
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    color: #6b7280 !important;
    padding: 0 !important;
    line-height: 1 !important;
    box-shadow: none !important;
    transition: background 0.15s, border-color 0.15s !important;
  }
  .btn-icono:hover { background: #f9fafb !important; border-color: #d1d5db !important; }
  .btn-eliminar:hover { background: #fef2f2 !important; border-color: #fca5a5 !important; color: #ef4444 !important; }

  /* ── Botones principales — !important para ganar a Bootstrap ── */
  .btn-analisis {
    padding: 8px 18px !important;
    border-radius: 10px !important;
    border: none !important;
    font-size: 0.88rem !important;
    font-weight: 600 !important;
    cursor: pointer !important;
    white-space: nowrap !important;
    display: inline-flex !important;
    align-items: center !important;
    text-decoration: none !important;
    transition: opacity 0.15s, transform 0.1s !important;
    box-shadow: none !important;
  }
  .btn-analisis:hover { opacity: 0.88 !important; transform: translateY(-1px) !important; }
  .btn-terminar  { background: #2563EB !important; color: #fff !important; }
  .btn-terminar:hover { background: #1d4ed8 !important; color: #fff !important; }
  .btn-cancelar  { background: #f3f4f6 !important; color: #374151 !important; border: 1px solid #e5e7eb !important; }
  .btn-cancelar:hover { color: #374151 !important; }

  /* ── Sesiones desplegables ── */
  .sesiones-lista {
    border-top: 1px solid #f3f4f6;
    background: #fafafa;
  }

  .sesiones-lista .aviso-vacio {
    border-radius: 0;
    margin: 0;
  }

  .sesion-vacia {
    padding: 12px 20px;
    font-size: 0.85rem;
    color: #9ca3af;
    font-style: italic;
  }
  .sesion-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 10px;
    padding: 9px 16px;
    border-bottom: 1px solid #f0f0f0;
    font-size: 0.87rem;
    color: #374151;
  }
  .sesion-item:last-child { border-bottom: none; }

  /* ── Modal overlay ── */
  #modal-paciente {
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,0.45);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 9999;
  }
  .modal-card {
    background: #fff;
    border-radius: 16px;
    padding: 28px;
    width: 100%;
    max-width: 500px;
    box-shadow: 0 8px 40px rgba(0,0,0,0.18);
  }
  .modal-card h3 {
    margin: 0 0 20px;
    font-size: 1.2rem;
    font-weight: 700;
    color: #111827;
  }
  .modal-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 14px;
    margin-bottom: 20px;
  }
  .modal-field { display: flex; flex-direction: column; gap: 5px; }
  .modal-field--full { grid-column: 1 / -1; }
  .modal-field label {
    font-size: 0.78rem;
    color: #6b7280;
    font-weight: 600;
    text-transform: uppercase;
    margin-bottom: 0;
  }
  .modal-field input {
    padding: 9px 12px !important;
    border: 1px solid #d1d5db !important;
    border-radius: 8px !important;
    font-size: 0.93rem !important;
    outline: none !important;
    box-shadow: none !important;
    transition: border-color 0.15s !important;
  }
  .modal-field input:focus {
    border-color: #2563EB !important;
    box-shadow: 0 0 0 2px rgba(37,99,235,0.15) !important;
  }
  .modal-botones { display: flex; justify-content: flex-end; gap: 10px; }

  /* ── Pantalla selección duración ── */
  #pantalla-inicio {
    display: none;
    align-items: center;
    justify-content: center;
    min-height: 60vh;
  }
  .selector-card {
    background: #fff;
    border-radius: 16px;
    box-shadow: 0 4px 24px rgba(0,0,0,0.10);
    padding: 36px 40px;
    text-align: center;
  }
  .selector-card h2 { margin: 0 0 24px; font-size: 1.3rem; color: #111827; }
  .opciones { display: flex; gap: 16px; flex-wrap: wrap; justify-content: center; }
  .opcion {
    width: 90px !important;
    height: 90px !important;
    border-radius: 14px !important;
    border: 2px solid #e5e7eb !important;
    background: #f9fafb !important;
    font-size: 1.15rem !important;
    font-weight: 700 !important;
    cursor: pointer !important;
    display: flex !important;
    flex-direction: column !important;
    align-items: center !important;
    justify-content: center !important;
    gap: 4px !important;
    color: #111827 !important;
    box-shadow: none !important;
  }
  .opcion span { font-size: 0.7rem; font-weight: 400; color: #9ca3af; }
  .opcion:hover { border-color: #6366f1 !important; background: #eef2ff !important; }

  /* ── Pantalla gráfica ── */
  #pantalla-grafica { max-width: 960px; margin: 24px auto; padding: 0 20px; }
  #barra-progreso-wrap { display: flex; align-items: center; gap: 12px; margin-bottom: 18px; }
  #barra-track { flex: 1; height: 10px; background: #e5e7eb; border-radius: 99px; overflow: hidden; }
  #barra-progreso { height: 100%; width: 0%; background: #2563EB; border-radius: 99px; transition: width 0.4s; }
  #tiempo-restante { font-size: 0.9rem; color: #6b7280; min-width: 48px; text-align: right; }

  .valores { display: flex; flex-wrap: wrap; gap: 10px; margin-bottom: 16px; }
  .valor {
    background: #fff;
    border-radius: 10px;
    padding: 10px 16px;
    font-size: 0.78rem;
    color: #9ca3af;
    text-transform: uppercase;
    min-width: 80px;
    box-shadow: 0 1px 4px rgba(0,0,0,0.07);
  }
  .valor span { display: block; font-size: 1.1rem; font-weight: 700; color: #111827; margin-top: 4px; }

  .chart-container {
    height: 300px;
    background: #fff;
    border-radius: 12px;
    padding: 12px;
    box-shadow: 0 1px 6px rgba(0,0,0,0.08);
    margin-bottom: 16px;
  }
  #botones-analisis { display: flex; gap: 10px; justify-content: flex-end; }

  /* ── Pantalla resumen ── */
  #pantalla-resumen { max-width: 900px; margin: 24px auto; padding: 0 20px; }
  .resumen-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
  .resumen-header h2 { margin: 0; font-size: 1.5rem; font-weight: 800; }
  #resumen-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(260px,1fr)); gap: 16px; margin-bottom: 20px; }
  #botones-resumen { display: flex; gap: 10px; justify-content: flex-end; margin-top: 16px; }

  @media (max-width: 640px) {
  .paciente-row {
    flex-wrap: wrap;
  }

  .paciente-info {
    flex-wrap: wrap;
    gap: 4px;
  }

  .paciente-nombre {
    white-space: normal;
    width: 100%;
  }

  .paciente-tel {
    white-space: normal;
  }

  .paciente-acciones {
    width: 100%;
    justify-content: flex-end;
    padding-top: 8px;
    border-top: 1px solid #f3f4f6;
  }
}

.aviso-vacio {
  background: #e5e7eb;
  color: #374151;
  border-radius: 10px;
  padding: 16px 20px;
  font-size: 0.9rem;
  text-align: center;
  font-style: italic;
}

</style>
@endpush

@section('content')

{{-- ── LISTA DE PACIENTES ── --}}
<div id="pantalla-pacientes">

  <div class="pacientes-header">
    <h2>Pacientes</h2>
    <button class="btn-analisis btn-terminar" onclick="abrirModalPaciente()">+ Añadir paciente</button>
  </div>

  <div class="pacientes-lista">
    @if (empty($pacientes))
      <div class="aviso-vacio">Sin pacientes registrados aún. Añade tu primer paciente.</div>
    @endif
    @foreach ($pacientes as $p)
    <div class="paciente-item" id="paciente-{{ $p['pacienteID'] }}">

      <div class="paciente-row">
        <div class="paciente-info" onclick="toggleSesiones({{ $p['pacienteID'] }})">
          <span class="paciente-nombre">
            {{ $p['nombre'] . ' ' . $p['apellido1'] . ' ' . ($p['apellido2'] ?? '') }}
          </span>
          <span class="paciente-tel">{{ $p['telefono'] }}</span>
          <span class="paciente-arrow" id="arrow-{{ $p['pacienteID'] }}">▸</span>
        </div>

        <div class="paciente-acciones">
          <button class="btn-icono btn-editar" title="Editar"
                  onclick='abrirModalEditar({{ json_encode($p) }})'>✎</button>
          <button class="btn-icono btn-eliminar" title="Eliminar"
                  onclick="eliminarPaciente({{ $p['pacienteID'] }})">✕</button>
          <button class="btn-analisis btn-terminar"
                  onclick="comenzarAnalisis({{ $p['pacienteID'] }})">Comenzar análisis</button>
        </div>
      </div>

      {{-- Desplegable sesiones --}}
      <div class="sesiones-lista" id="sesiones-{{ $p['pacienteID'] }}" style="display:none">
      @if (empty($p['sesiones']) || is_null($p['sesiones']))
        <div class="sesion-vacia aviso-vacio">Sin análisis registrados para este paciente.</div>
      @else
        @foreach ($p['sesiones'] as $s)
          <div class="sesion-item">
            <a style="flex:1; text-decoration:none; color:inherit; display:flex; gap:16px;"
              href="{{ route('panel.resumen', ['pacienteID' => $p['pacienteID'], 'sesionID' => $s['sesionID']]) }}">
              <span>📅 {{ \Carbon\Carbon::parse($s['fecha_hora_inicio'])->format('d/m/Y H:i') }}</span>
              <span>⏱ {{ $s['duracion'] }}s</span>
            </a>
            <button class="btn-icono btn-eliminar"
                    title="Eliminar sesión"
                    onclick="eliminarSesion({{ $s['sesionID'] }})">✕</button>
          </div>
        @endforeach
      @endif
    </div>
      </div>

    </div>
    @endforeach
  </div>

{{-- ── PANTALLA SELECCIÓN DE DURACIÓN ── --}}
<div id="pantalla-inicio" style="display:none">
  <div class="selector-card">
    <h2>¿Cuánto tiempo dura el análisis?</h2>
    <div class="opciones">
      <button class="opcion" onclick="iniciar(5000)">5s <span>Prueba</span></button>
      <button class="opcion" onclick="iniciar(30000)">30s</button>
      <button class="opcion" onclick="iniciar(60000)">1m</button>
      <button class="opcion" onclick="iniciar(300000)">5m</button>
    </div>
  </div>
</div>

{{-- ── MODAL PACIENTE ── --}}
<div id="modal-paciente" style="display:none">
  <div class="modal-card">
    <h3 id="modal-titulo">Añadir paciente</h3>
    <input type="hidden" id="modal-pacienteID">
    <div class="modal-grid">
      <div class="modal-field">
        <label>Nombre</label>
        <input type="text" id="m-nombre" placeholder="Nombre">
      </div>
      <div class="modal-field">
        <label>Primer apellido</label>
        <input type="text" id="m-apellido1" placeholder="Primer apellido">
      </div>
      <div class="modal-field">
        <label>Segundo apellido</label>
        <input type="text" id="m-apellido2" placeholder="Segundo apellido">
      </div>
      <div class="modal-field">
        <label>Teléfono</label>
        <input type="text" id="m-telefono" placeholder="Teléfono">
      </div>
      <div class="modal-field">
        <label>Fecha de nacimiento</label>
        <input type="date" id="m-fechaNacimiento">
      </div>
      <div class="modal-field modal-field--full">
        <label>Dirección</label>
        <input type="text" id="m-direccion" placeholder="Dirección">
      </div>
    </div>
    <div class="modal-botones">
      <button class="btn-analisis btn-cancelar" onclick="cerrarModal()">Cancelar</button>
      <button class="btn-analisis btn-terminar" onclick="guardarPaciente()">Guardar</button>
    </div>
  </div>
</div>

{{-- ── PANTALLA SELECCIÓN DE DURACIÓN ── --}}
<div id="pantalla-inicio" style="display:none">
  <div class="selector-card">
    <h2>¿Cuánto tiempo dura el análisis?</h2>
    <div class="opciones">
      <button class="opcion" onclick="iniciar(5000)">5s <span>Prueba</span></button>
      <button class="opcion" onclick="iniciar(30000)">30s</button>
      <button class="opcion" onclick="iniciar(60000)">1m</button>
      <button class="opcion" onclick="iniciar(300000)">5m</button>
    </div>
  </div>
</div>

{{-- ── PANTALLA GRÁFICA EEG ── --}}
<div id="pantalla-grafica" style="display:none">

  <div id="barra-progreso-wrap">
    <div id="barra-track">
      <div id="barra-progreso"></div>
    </div>
    <span id="tiempo-restante">Listo</span>
    <button id="btn-control" class="btn-analisis btn-terminar" onclick="toggleAnalisis()">▶ Iniciar</button>
  </div>

  <div class="valores">
    <div class="valor">Señal   <br><span id="signal">-</span></div>
    <div class="valor">Delta   <br><span id="delta">-</span></div>
    <div class="valor">Theta   <br><span id="theta">-</span></div>
    <div class="valor">Alpha L <br><span id="lowAlpha">-</span></div>
    <div class="valor">Alpha H <br><span id="highAlpha">-</span></div>
    <div class="valor">Beta L  <br><span id="lowBeta">-</span></div>
    <div class="valor">Beta H  <br><span id="highBeta">-</span></div>
    <div class="valor">Gamma L <br><span id="lowGamma">-</span></div>
  </div>

  <div class="chart-container">
    <canvas id="grafica"></canvas>
  </div>

  <div id="botones-analisis">
    <button class="btn-analisis btn-cancelar" onclick="cancelarAnalisis()">✕ Cancelar análisis</button>
    <button class="btn-analisis btn-terminar" onclick="terminarAnalisis()">✓ Terminar análisis</button>
  </div>

</div>

{{-- ── PANTALLA RESUMEN (inline) ── --}}
<div id="pantalla-resumen" style="display:none">

  <div class="resumen-header">
    <h2>Resumen del análisis</h2>
    <button class="btn-analisis btn-cancelar" onclick="volverInicio()">← Nuevo análisis</button>
  </div>

  <div id="resumen-grid"></div>

  <div style="background:#fff; border-radius:12px; box-shadow:0 2px 12px rgba(0,0,0,0.08); padding:20px; margin-bottom:16px;">
    <label style="font-size:0.78rem; color:#9ca3af; text-transform:uppercase; display:block; margin-bottom:8px;">
      Notas médicas
    </label>
    <textarea id="notas-medicas" rows="4"
      style="width:100%; padding:12px; border:1px solid #d1d5db; border-radius:8px;
             font-size:0.95rem; resize:vertical; box-sizing:border-box; outline:none;"
      placeholder="Escribe aquí tus observaciones..."></textarea>
  </div>

  <div id="botones-resumen">
    <button class="btn-analisis btn-cancelar" onclick="volverInicio()">✕ Salir del análisis</button>
    <button class="btn-analisis btn-terminar" onclick="guardarAnalisis()">↓ Guardar análisis</button>
  </div>

</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>

// ─────────────────────────────────────────────
// CONSTANTES LARAVEL
// ─────────────────────────────────────────────

const CSRF  = '{{ csrf_token() }}';
const RUTAS = {
    crearPaciente:    '{{ route("panel.crearPaciente") }}',
    editarPaciente:   '{{ route("panel.editarPaciente") }}',
    eliminarPaciente: '{{ route("panel.eliminarPaciente") }}',
    guardarSesion:    '{{ route("panel.guardarSesion") }}',
    eliminarSesion:   '{{ route("panel.eliminarSesion") }}',
};

// ─────────────────────────────────────────────
// ESTADO GLOBAL
// ─────────────────────────────────────────────

let pacienteSeleccionado = null;
let fechaInicioAnalisis  = null;
const MAX_PUNTOS         = 30;
let ws            = null;
let timerInterval = null;
let duracionTotal = 0;
let tiempoInicio  = 0;
let corriendo     = false;
let pausado       = false;
let tiempoPausado = 0;

const historial = {
  delta: [], theta: [],
  lowAlpha: [], highAlpha: [],
  lowBeta: [],  highBeta: [],
  lowGamma: [], highGamma: []
};

const ONDAS = [
  { key: 'delta',     label: 'Delta',   color: '#ef4444', desc: '0.5–4 Hz · sueño profundo' },
  { key: 'theta',     label: 'Theta',   color: '#f59e0b', desc: '4–8 Hz · somnolencia, creatividad' },
  { key: 'lowAlpha',  label: 'Alpha L', color: '#3b82f6', desc: '8–10 Hz · relajación' },
  { key: 'highAlpha', label: 'Alpha H', color: '#60a5fa', desc: '10–12 Hz · calma activa' },
  { key: 'lowBeta',   label: 'Beta L',  color: '#22c55e', desc: '12–21 Hz · concentración' },
  { key: 'highBeta',  label: 'Beta H',  color: '#84cc16', desc: '21–30 Hz · alerta, estrés' },
  { key: 'lowGamma',  label: 'Gamma',   color: '#a855f7', desc: '30–50 Hz · procesamiento cognitivo' },
];

// ─────────────────────────────────────────────
// PACIENTES
// ─────────────────────────────────────────────

function toggleSesiones(id) {
  const el    = document.getElementById('sesiones-' + id);
  const arrow = document.getElementById('arrow-' + id);
  const abierto = el.style.display !== 'none';
  el.style.display  = abierto ? 'none' : 'block';
  arrow.textContent = abierto ? '▸' : '▾';
}

function comenzarAnalisis(pacienteID) {
  pacienteSeleccionado = pacienteID;
  document.getElementById('pantalla-pacientes').style.display = 'none';
  document.getElementById('pantalla-inicio').style.display    = 'flex';
}

// ─────────────────────────────────────────────
// MODAL
// ─────────────────────────────────────────────

function abrirModalPaciente() {
  document.getElementById('modal-titulo').textContent = 'Añadir paciente';
  document.getElementById('modal-pacienteID').value   = '';
  ['nombre','apellido1','apellido2','telefono','fechaNacimiento','direccion']
    .forEach(f => { document.getElementById('m-' + f).value = ''; });
  document.getElementById('modal-paciente').style.display = 'flex';
}

function abrirModalEditar(p) {
  document.getElementById('modal-titulo').textContent      = 'Editar paciente';
  document.getElementById('modal-pacienteID').value        = p.pacienteID;
  document.getElementById('m-nombre').value                = p.nombre              ?? '';
  document.getElementById('m-apellido1').value             = p.apellido1            ?? '';
  document.getElementById('m-apellido2').value             = p.apellido2            ?? '';
  document.getElementById('m-telefono').value              = p.telefono             ?? '';
  document.getElementById('m-fechaNacimiento').value       = p.fecha_de_nacimiento  ?? '';
  document.getElementById('m-direccion').value             = p.direccion            ?? '';
  document.getElementById('modal-paciente').style.display = 'flex';
}

function cerrarModal() {
  document.getElementById('modal-paciente').style.display = 'none';
}

function guardarPaciente() {
  const id  = document.getElementById('modal-pacienteID').value;
  const url = id ? RUTAS.editarPaciente : RUTAS.crearPaciente;

  const body = new FormData();
  body.append('_token', CSRF);
  if (id) body.append('pacienteID', id);
  body.append('nombre',          document.getElementById('m-nombre').value);
  body.append('apellido1',       document.getElementById('m-apellido1').value);
  body.append('apellido2',       document.getElementById('m-apellido2').value);
  body.append('telefono',        document.getElementById('m-telefono').value);
  body.append('fechaNacimiento', document.getElementById('m-fechaNacimiento').value);
  body.append('direccion',       document.getElementById('m-direccion').value);

  fetch(url, { method: 'POST', body })
    .then(r => r.json())
    .then(r => {
      if (r.ok) { location.reload(); }
      else      { alert('Error al guardar el paciente'); }
    });
}

function eliminarPaciente(id) {
  if (!confirm('¿Eliminar este paciente?')) return;

  const body = new FormData();
  body.append('_token', CSRF);
  body.append('pacienteID', id);

  fetch(RUTAS.eliminarPaciente, { method: 'POST', body })
    .then(r => r.json())
    .then(r => {
      if (r.ok) {
        document.getElementById('paciente-' + id)?.remove();
        document.getElementById('sesiones-' + id)?.remove();
      }
    });
}

// ─────────────────────────────────────────────
// GRÁFICA
// ─────────────────────────────────────────────

const datos = {
  labels: [],
  datasets: [
    { label: 'Delta', data: [], borderColor: '#ef4444', tension: 0.3 },
    { label: 'Theta', data: [], borderColor: '#f59e0b', tension: 0.3 },
    { label: 'Alpha', data: [], borderColor: '#60a5fa', tension: 0.3 },
    { label: 'Beta',  data: [], borderColor: '#22c55e', tension: 0.3 },
    { label: 'Gamma', data: [], borderColor: '#a855f7', tension: 0.3 },
  ]
};

const chart = new Chart(document.getElementById('grafica'), {
  type: 'line',
  data: datos,
  options: {
    animation: false,
    responsive: true,
    maintainAspectRatio: false,
    scales: {
      y: { ticks: { color: '#aaa' }, grid: { color: '#333' } }
    }
  }
});

// ─────────────────────────────────────────────
// INICIAR ANÁLISIS
// ─────────────────────────────────────────────

function iniciar(duracionMs) {
  duracionTotal = duracionMs;
  document.getElementById('pantalla-inicio').style.display  = 'none';
  document.getElementById('pantalla-grafica').style.display = 'block';
}

// ─────────────────────────────────────────────
// WEBSOCKET
// ─────────────────────────────────────────────

function iniciarWS() {
  if (!fechaInicioAnalisis) {
    fechaInicioAnalisis = new Date().toISOString().slice(0,19).replace('T',' ');
  }
  ws = new WebSocket("wss://aurora-eeg.com/ws");
  ws.onopen    = () => console.log("Conectado al WebSocket");
  ws.onerror   = (e) => console.error("Error WS:", e);
  ws.onclose   = () => console.log("WebSocket cerrado");
  ws.onmessage = (event) => {
    if (!corriendo) return;
    if (Date.now() - tiempoInicio >= duracionTotal) return;
    const d = JSON.parse(event.data);
    actualizarValores(d);
    actualizarGrafica(d);
  };
}

// ─────────────────────────────────────────────
// CONTROL ANÁLISIS
// ─────────────────────────────────────────────

function toggleAnalisis() {
  if (!corriendo && !pausado) {
    iniciarWS();
    tiempoInicio  = Date.now();
    timerInterval = setInterval(actualizarBarra, 500);
    corriendo     = true;
    document.getElementById('btn-control').textContent = '⏸ Pausar';
  } else if (corriendo && !pausado) {
    pausado       = true;
    corriendo     = false;
    tiempoPausado = Date.now() - tiempoInicio;
    clearInterval(timerInterval);
    if (ws) ws.close();
    document.getElementById('btn-control').textContent = '▶ Continuar';
  } else if (pausado) {
    tiempoInicio  = Date.now() - tiempoPausado;
    pausado       = false;
    corriendo     = true;
    iniciarWS();
    timerInterval = setInterval(actualizarBarra, 500);
    document.getElementById('btn-control').textContent = '⏸ Pausar';
  }
}

function actualizarBarra() {
  const transcurrido = Date.now() - tiempoInicio;
  const pct          = Math.min(100, (transcurrido / duracionTotal) * 100);
  document.getElementById('barra-progreso').style.width  = pct + '%';
  const restante = Math.max(0, Math.ceil((duracionTotal - transcurrido) / 1000));
  document.getElementById('tiempo-restante').textContent = restante + 's';
  if (transcurrido >= duracionTotal) finalizarAnalisis();
}

function finalizarAnalisis() {
  clearInterval(timerInterval);
  corriendo = false;
  pausado   = false;
  if (ws) ws.close();
  document.getElementById('barra-progreso').style.width  = '100%';
  document.getElementById('tiempo-restante').textContent = 'Completado';
  document.getElementById('btn-control').textContent     = '✓ Finalizado';
  document.getElementById('btn-control').disabled        = true;
}

// ─────────────────────────────────────────────
// DATOS
// ─────────────────────────────────────────────

function convertirOnda(valor, minHz, maxHz, minRaw, maxRaw) {
  const minRawExt = minRaw * 0.3;
  const maxRawExt = maxRaw * 1.5;

  valor = Math.max(minRawExt, Math.min(valor, maxRawExt));

  const normalizado =
    (Math.log10(valor) - Math.log10(minRawExt)) /
    (Math.log10(maxRawExt) - Math.log10(minRawExt));

  const margen = (maxHz - minHz) * 0.3;

  return (minHz - margen) + normalizado * ((maxHz + margen) - (minHz - margen));
}

function actualizarGrafica(d) {
  const hora = new Date().toLocaleTimeString();

  const logDelta     = convertirOnda(d.delta     || 1, 0.5,  4,  100000, 2000000);
  const logTheta     = convertirOnda(d.theta     || 1, 4,    8,  50000,  1500000);
  const logLowAlpha  = convertirOnda(d.lowAlpha  || 1, 8,    10, 50000,  600000);
  const logHighAlpha = convertirOnda(d.highAlpha || 1, 10,   12, 50000,  700000);
  const logLowBeta   = convertirOnda(d.lowBeta   || 1, 12,   21, 30000,  800000);
  const logHighBeta  = convertirOnda(d.highBeta  || 1, 21,   30, 30000,  1000000);
  const logLowGamma  = convertirOnda(d.lowGamma  || 1, 30,   50, 30000,  1000000);

  const alpha = (logLowAlpha + logHighAlpha) / 2;
  const beta  = (logLowBeta  + logHighBeta)  / 2;
  const gamma = logLowGamma;

  datos.labels.push(hora);
  datos.datasets[0].data.push(logDelta);
  datos.datasets[1].data.push(logTheta);
  datos.datasets[2].data.push(alpha);
  datos.datasets[3].data.push(beta);
  datos.datasets[4].data.push(gamma);

  if (datos.labels.length > MAX_PUNTOS) {
    datos.labels.shift();
    datos.datasets.forEach(ds => ds.data.shift());
  }
  chart.update();
}

function actualizarValores(d) {
  const vals = {
    delta:     convertirOnda(d.delta     || 1, 0.5, 4,  100000, 2000000),
    theta:     convertirOnda(d.theta     || 1, 4,   8,  50000,  1500000),
    lowAlpha:  convertirOnda(d.lowAlpha  || 1, 8,   10, 50000,  600000),
    highAlpha: convertirOnda(d.highAlpha || 1, 10,  12, 50000,  700000),
    lowBeta:   convertirOnda(d.lowBeta   || 1, 12,  21, 30000,  800000),
    highBeta:  convertirOnda(d.highBeta  || 1, 21,  30, 30000,  1000000),
    lowGamma:  convertirOnda(d.lowGamma  || 1, 30,  50, 30000,  1000000),
  };
  Object.entries(vals).forEach(([k, v]) => {
    const el = document.getElementById(k);
    if (el) el.textContent = v.toFixed(2);
    if (historial[k]) historial[k].push(v);
  });
}

// ─────────────────────────────────────────────
// CANCELAR / VOLVER
// ─────────────────────────────────────────────

function cancelarAnalisis() {
  clearInterval(timerInterval);
  corriendo = false;
  pausado   = false;
  if (ws) ws.close();
  datos.labels = [];
  datos.datasets.forEach(ds => ds.data = []);
  chart.update();
  Object.keys(historial).forEach(k => historial[k] = []);
  document.getElementById('barra-progreso').style.width       = '0%';
  document.getElementById('tiempo-restante').textContent      = 'Listo';
  document.getElementById('btn-control').textContent          = '▶ Iniciar';
  document.getElementById('btn-control').disabled             = false;
  document.getElementById('pantalla-grafica').style.display   = 'none';
  document.getElementById('pantalla-pacientes').style.display = 'block';
}

function volverInicio() {
  datos.labels = [];
  datos.datasets.forEach(ds => ds.data = []);
  chart.update();
  Object.keys(historial).forEach(k => historial[k] = []);
  document.getElementById('barra-progreso').style.width       = '0%';
  document.getElementById('tiempo-restante').textContent      = 'Listo';
  document.getElementById('btn-control').textContent          = '▶ Iniciar';
  document.getElementById('btn-control').disabled             = false;
  document.getElementById('pantalla-resumen').style.display   = 'none';
  document.getElementById('pantalla-pacientes').style.display = 'block';
  location.reload();
}

// ─────────────────────────────────────────────
// ESTADÍSTICAS
// ─────────────────────────────────────────────

function media(arr)       { return arr.reduce((a,b) => a+b, 0) / arr.length; }
function mediana(arr)     { const s=[...arr].sort((a,b)=>a-b), m=Math.floor(s.length/2); return s.length%2?s[m]:(s[m-1]+s[m])/2; }
function desviacion(a,m)  { return Math.sqrt(a.reduce((s,v)=>s+Math.pow(v-m,2),0)/a.length); }
function percentil(arr,p) { const s=[...arr].sort((a,b)=>a-b); return s[Math.floor(p/100*s.length)]; }
function calcularStats(arr) {
  const med = media(arr);
  return { max:Math.max(...arr), min:Math.min(...arr), media:med, mediana:mediana(arr),
           desv:desviacion(arr,med), p25:percentil(arr,25), p75:percentil(arr,75), muestras:arr.length };
}
function fmt(n) { return Number(n).toFixed(2) + 'Hz'; }

// ─────────────────────────────────────────────
// RESUMEN
// ─────────────────────────────────────────────

function terminarAnalisis() {
  finalizarAnalisis();
  const grid = document.getElementById('resumen-grid');
  grid.innerHTML = '';

  ONDAS.forEach(onda => {
    const arr = historial[onda.key];
    if (!arr || arr.length === 0) return;
    const s = calcularStats(arr);
    grid.innerHTML += `
      <div style="background:#fff;border-radius:12px;box-shadow:0 2px 12px rgba(0,0,0,0.08);overflow:hidden">
        <div style="padding:14px 16px;background:#f9fafb;border-left:4px solid ${onda.color};border-bottom:1px solid #e5e7eb">
          <div style="font-size:1rem;font-weight:700;color:${onda.color}">${onda.label}</div>
          <div style="font-size:0.75rem;color:#6b7280;margin-top:2px">${onda.desc}</div>
        </div>
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;padding:16px">
          ${[['Máximo',fmt(s.max)],['Mínimo',fmt(s.min)],['Media',fmt(s.media)],
             ['Mediana',fmt(s.mediana)],['Desv. típica',fmt(s.desv)],
             ['Percentil 25',fmt(s.p25)],['Percentil 75',fmt(s.p75)]]
            .map(([l,v]) => `
              <div>
                <div style="font-size:0.7rem;color:#9ca3af;text-transform:uppercase">${l}</div>
                <div style="font-size:1.05rem;font-weight:700;color:#111">${v}</div>
              </div>`).join('')}
        </div>
      </div>`;
  });

  document.getElementById('pantalla-grafica').style.display = 'none';
  document.getElementById('pantalla-resumen').style.display = 'block';
}

// ─────────────────────────────────────────────
// GUARDAR ANÁLISIS
// ─────────────────────────────────────────────

function guardarAnalisis() {
  const notas    = document.getElementById('notas-medicas').value;
  const fechaFin = new Date().toISOString().slice(0,19).replace('T',' ');
  const resumen  = {};
  ONDAS.forEach(o => { const a = historial[o.key]; if (a && a.length) resumen[o.key] = calcularStats(a); });

  const body = new FormData();
  body.append('_token',      CSRF);
  body.append('pacienteID',  pacienteSeleccionado);
  body.append('fechaInicio', fechaInicioAnalisis);
  body.append('fechaFin',    fechaFin);
  body.append('duracion',    Math.round(duracionTotal / 1000));
  body.append('datosEeg',    JSON.stringify(resumen));
  body.append('notas',       notas);

  fetch(RUTAS.guardarSesion, { method: 'POST', body })
    .then(r => r.json())
    .then(r => {
      if (r.ok) { alert('Análisis guardado correctamente'); location.reload(); }
      else      { alert('Error al guardar'); }
    });
}

function eliminarSesion(id) {
  if (!confirm('¿Eliminar esta sesión?')) return;

  const body = new FormData();
  body.append('_token',   CSRF);
  body.append('sesionID', id);

  fetch(RUTAS.eliminarSesion, { method: 'POST', body })
    .then(r => r.json())
    .then(r => {
      if (r.ok) { location.reload(); }
      else      { alert('Error al eliminar sesión'); }
    });
}

</script>
@endpush