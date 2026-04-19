<div class="panel-container">

    <div class="top-bar">
        <h1>Mis Pacientes</h1>
        <button type="button" class="boton-registrar" data-bs-toggle="modal" data-bs-target="#registrarPaciente">
            Registrar Paciente
        </button>
    </div>

    <div class="tabla-container">
        <table class="tabla-pacientes">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Edad</th>
                    <th>DNI</th>
                    <th>Teléfono</th>
                    <th>Fecha de Nacimiento</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="tablaPacientes">
                <?php foreach ($data['pacientes'] as $p): ?>
                <tr>
                    <td><?= $p['nombre'] ?></td>
                    <td><?= $p['edad'] ?? '' ?></td>
                    <td><?= $p['dni'] ?? '' ?></td>
                    <td><?= $p['telefono'] ?></td>
                    <td><?= $p['fecha_de_nacimiento'] ?></td>
                    <td>
                        <button class="boton-ver">Ver</button>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</div>

<div class="modal fade" id="registrarPaciente" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content register-card">

            <div class="modal-header border-0 pb-0">
                <h5 class="register-title w-100">Registrar Paciente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body pt-2">
                <form action="<?=$http->getUrlBase()?>/PanelControl/registrarPaciente" method="POST" class="register-form">

                    <div class="form-row two-columns">
                        <input type="text" name="nombre" placeholder="Nombre">
                        <input type="text" name="apellidos" placeholder="Apellidos">
                    </div>

                    <div class="form-row">
                        <input type="number" name="edad" placeholder="Edad">
                    </div>

                    <div class="form-row">
                        <input type="text" name="dni" placeholder="DNI">
                    </div>

                    <div class="form-row">
                        <input type="text" name="telefono" placeholder="Teléfono">
                    </div>

                    <div class="form-row">
                        <input type="date" name="fecha">
                    </div>

                    <div class="modal-footer border-0 px-0 pb-0">
                        <button type="button" class="boton-cancelar" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="register-button">Registrar</button>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>