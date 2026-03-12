<div class="register-container">
    <div class="register-card">
        <h2 class="register-title">Crear cuenta</h2>

        <?php if (!empty($data['error'])): ?>
            <div class="error-message">
                <?= $data['error'] ?>
            </div>
        <?php endif; ?>

        <form action="<?=$http->getUrlBase()?>/Registro/registrarUsuario" method="POST" class="register-form">
            <div class="form-row">
                <input type="text" name="username" placeholder="Usuario">
            </div>

            <div class="form-row two-columns">
                <input type="text" name="nombre" placeholder="Nombre">
                <input type="text" name="apellido1" placeholder="Primer apellido">
            </div>

            <div class="form-row">
                <input type="text" name="apellido2" placeholder="Segundo apellido">
            </div>

            <div class="form-row">
                <input type="email" name="email" placeholder="Correo electrónico">
            </div>

            <div class="form-row two-columns">
                <input type="password" name="password" placeholder="Contraseña">
                <input type="password" name="password2" placeholder="Repetir contraseña">
            </div>

            <div class="form-row">
                <select name="hospital" id="hospital-select">
                    <option value="" selected=true>Selecciona un hospital</option>

                    <?php foreach ($data['hospitales'] as $hospital): ?>
                        <option value="<?= $hospital['hospitalID'] ?>">
                            <?= $hospital['nombre'] ?>
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

        <div class="mt-4 text-center">
            <p>¿Ya tienes una cuenta? <a href="<?=$http->getUrlBase()?>/Login">Inicia Sesión aquí</a></p>
        </div>
    </div>
</div>