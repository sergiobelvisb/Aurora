<h1>Mi Perfil</h1>

<main>
    <div class="perfil-container">
        <!-- Imagen perfil -->
        <div class="perfil-imagen">
            <img style="margin-left: -15px"src="<?=$this->data['fotodeperfil']?>" alt="Perfil">
        </div>

        <!-- Datos de usuario -->
        <div class="perfil-datos">
            <p><strong>ID de usuario:</strong> <?=$this->data['id']?></p>
            <p><strong>Nombre de usuario:</strong> <?=$this->data['usuario']?></p>
            <p><strong>Rol dentro de la página web:</strong> <?=$this->data['acl']?></p>

            <div class="perfil-botones">
                <a href="Perfil/ConfPerfil">
                    <button>Configurar</button>
                </a>
                <a href="Tienda">
                    <button>Volver</button>
                </a>
            </div>
        </div>
    </div>
</main>