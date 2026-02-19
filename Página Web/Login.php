<?php

if (isset($_POST['enviar'])) {
    if (isset($_POST['usuario']) && !empty($_POST['usuario'])) {
        if (isset($_POST['password']) && !empty($_POST['password'])) {

        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
    <link rel="stylesheet" href="index.css">
</head>

<body>
    <div class="page-wrapper">
        <div class="login-container">
            <form class="login-form" action="<?= $_SERVER['PHP_SELF']; ?>" method="post">
                <h2>Acceso al Sistema</h2>

                <label for="usuario">Usuario</label>
                <input type="text" name="usuario" id="usuario">

                <label for="password">Contraseña</label>
                <input type="password" name="password" id="password">

                <input type="submit" name="enviar" value="Entrar" class="btn-login">
            </form>
        </div>
    </div>


</body>

</html>