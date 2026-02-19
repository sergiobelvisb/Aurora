<h1>Configuración de Perfil</h1>

<main>
        <form action="<?= $http->getUrlBase();?>/Perfil/ActualizarPerfil" method="POST" enctype="multipart/form-data">
        <div class="perfil-container">
            <div class="perfil-imagen">
                <img src="<?=$this->data['fotodeperfil']?>" alt="Foto de perfil">
                <br> <br>
                <input type="file" name="foto_perfil" id="input-imagen" accept=".jpg">
            </div>

            <div class="perfil-datos">
                <label for="username">Nombre de usuario:</label>
                <input type="text" id="username" name="username" value= <?=$this->data['usuario'] ?> required>

                <label for="password">Nueva contraseña:</label>
                <input type="password" id="password" name="password" placeholder="Dejar vacío para no cambiar">

                <?php

                    if($this->data['admin']){
                        echo "<label for='acl'>Rol ACL:</label>";
                        echo "<input type='text' id='acl' name='acl' value='". $this->data['acl'] ."'</input>";
                    }

                ?>

                <div class="guardar-boton">
                    <button type="submit">Guardar cambios</button>
                </div>
            </div>
        </div>

        <div>
            <?php
                if(!$this->data['admin']){
                    echo "<a href='Aviso'>";
                    echo "<button class='actions'>Eliminar cuenta</button>";
                    echo "</a>";
                }
            ?>
            <a href="../Perfil">
                <button class="actions">Volver</button>
            </a>
        </div>
    </form>
</main>