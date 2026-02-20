<div class="register-container">

    <div class="register-card">

        <h2 class="register-title">Crear cuenta</h2>

        <?php if (!empty($data['error'])): ?>
            <div class="error-message">
                <?= $data['error'] ?>
            </div>
        <?php endif; ?>

        <form action="" method="POST" class="register-form">

            <div class="form-row">
                <input class="form-required" type="text" name="username" placeholder="Usuario" required>
            </div>

            <div class="form-row two-columns">
                <input class="form-required" type="text" name="nombre" placeholder="Nombre" required>
                <input class="form-required" type="text" name="apellido1" placeholder="Primer apellido" required>
            </div>

            <div class="form-row">
                <input type="text" name="apellido2" placeholder="Segundo apellido">
            </div>

            <div class="form-row">
                <input class="form-required" type="email" name="email" placeholder="Correo electrónico" required>
            </div>

            <div class="form-row two-columns-required">
                <input class="form-required" type="password" name="password" placeholder="Contraseña" required>
                <input class="form-required" type="password" name="password2" placeholder="Repetir contraseña" required>
            </div>

            <div class="form-row">
                <select class="selectpicker" data-show-subtext="true" data-live-search="true" name="hospital">
                    <option value="default" selected="true">Elige su Hospital</option>
                    <?php foreach ($data['hospitales'] as $hospital): ?>
                        <option value="<?= $hospital ?>">
                            <?= $hospital ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-row">
                <button type="submit" class="register-button">
                    Registrarse
                </button>
            </div>

        </form>

    </div>

</div>