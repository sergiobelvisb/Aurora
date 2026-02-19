<h1>Registrar Usuario</h1>

<?php
    if(isset($error) && $error != ""){
        echo "<p style='color:red;'>$error</p>";
    }
?>

<fieldset>
    <form id="formLogSign" action="Registro" method="post">
        <label for="username">Nombre de usuario: </label>
        <input type="text" name="username" required>
        <br>
        <label for="password">Contraseña: </label>
        <input type="password" name="password" required>
        <br>
        <label for="password2">Repite contraseña: </label>
        <input type="password" name="password2" required>
        <br>
        <input class="btnLogSign" type="submit" name="enviar" value="Registrar">
    </form>
</fieldset>
<p>
    <a href="<?= $http->getUrlBase();?>/LogIn">
        ¿Ya tienes una cuenta?
    </a>
</p>