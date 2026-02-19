<h1>Listado de vistas</h1>

<main>
    <h2><strong>¡Hola <?=$this->data['usuario']?>! ¿A dónde te quieres redirigir?</strong></h2>

    <ol>
        <li>
            <a href="AdminUsuarios">
                Administrar Usuarios
            </a>
        </li>
        <li>
            <a href="AdminProductos">
                Administrar Productos
            </a>
        </li>
        <li>
            <a href="Tienda">
                Tienda
            </a>
        </li>
    </ol>
    <br>
    <a href="LogOut">
        <button class="actions">Cerrar Sesion</button>
    </a>
</main>