<!-- Contenedor central del login -->
<div class="login-container d-flex justify-content-center align-items-center">
    <div class="login-card p-5 shadow-sm rounded">
        <h2 class="text-center mb-4">Iniciar sesión</h2>

        <?php if (!empty($data['error'])): ?>
            <div class="alert alert-danger text-center">
                <?php echo $data['error']; ?>
            </div>
        <?php endif; ?>

        <form action="<?=$http->getUrlBase()?>/Login/comprobarSesion" method="POST">
            <div class="mb-3">
                <label for="email" class="form-label">Correo electrónico</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="usuario@ejemplo.com" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="********" required>
            </div>

            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="remember">
                    <label class="form-check-label" for="remember">Recordarme</label>
                </div>
                <a href="#" class="forgot-link">¿Olvidaste tu contraseña?</a>
            </div>

            <button type="submit" class="btn btn-primary w-100">Iniciar sesión</button>
        </form>

        <div class="mt-4 text-center">
            <p>¿No tienes cuenta? <a href="#">Regístrate aquí</a></p>
        </div>
    </div>
</div>