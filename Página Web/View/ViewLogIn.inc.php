<h1>Iniciar Sesión</h1>

<form id="formLogSign" action="<?= $http->getUrlBase();?>/LogIn/Login" method="POST">
    <fieldset>
        <label for="login">Usuario: </label>
        <input type="text" id="username" name="username">
        <br>
        <label for="password">Contraseña: </label>
        <input type="password" id="password" name="password">
        <br> <br>
        <input class="btnLogSign" type="submit" id="submit" name="submit" value="Enviar">
    </fieldset>
</form>
<p>
    <a href="<?= $http->getUrlBase();?>/SignIn">
        ¿No tienes cuenta?
    </a>
</p>