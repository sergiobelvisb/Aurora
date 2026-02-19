<h1>Administrar Usuarios</h1>
<main>
    <form action="<?=$http->getUrlBase()?>/AdminUsuarios/Usuario" method="POST">
        <fieldset>
            <legend>Datos del Usuario</legend>

            <label for="user">Usuario: </label>
            <input type="text" id="user" name="user" value="<?=$this->data['nombre']?>">
            <br>

            <label for="acl">ACL: </label>
            <input type="text" id="acl" name="acl" placeholder="custom">
            <br>

            <label for="delete">
                Delete Virtual: 
                <input type="checkbox" id="delete" name="delete">
            </label>
            <br> <br>

            <input class="btnLogSign" type="submit" id="submit" name="submit" value="Enviar">
        </fieldset>
    </form>

    <div>
        <a href="../../AdminUsuarios">
            <button class="actions">Volver</button>
        </a>
    </div>
</main>