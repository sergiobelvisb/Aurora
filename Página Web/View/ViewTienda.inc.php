<h1>Tienda</h1>
<main>
    <form id="formTienda" method="POST">
        <div class="paginacion">
            <?php 
                if($this->data['pagina'] > 1){ 
                    echo "<button id='Atras' name='cambiarPagina' value='" . $this->data['pagina'] - 1 . "'><img class='direccion' src='public/img/flecha-izquierda.png' style='width: 50px; height: 50px'></button></a>"; 
                }
                
                echo "<p style='align-self: center'>Página " . $this->data['pagina'] . " de " . $this->data['totalPaginas'] . "</p>";

                if($this->data['pagina'] < $this->data['totalPaginas']){ 
                    echo "<button id='Adelante' name='cambiarPagina' value='" . $this->data['pagina'] + 1 . "'><img class='direccion' src='public/img/flecha-derecha.png' style='width: 50px; height: 50px'></button></a>";
                }
            ?>
        </div>

        <select name="categoria">
            <option selected="true" value="Todas">Todas las Categorías</option>
            <?php
                foreach ($this->data['categorias'] as $categoria){
                    echo "<option value='$categoria'> $categoria</option>";
                }
            ?>
        </select>

        &nbsp;

        <input id="filtrar" type="submit" name="filtrar" value="Confirmar filtro">

        <a href="Perfil" class="perfil-btn">
            <img src="<?=$this->data['fotodeperfil']?>" alt="FotoDePerfil">
        </a>

        <table>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Categoría</th>
                <!--<th>Comprar</th>-->
            </tr>

            <?php 
                foreach ($this->data['productos'] as $producto){
                    echo "<tr>";
                    echo "<td> " . $producto['id'] . "</td>";
                    echo "<td> " . $producto['nombre'] . "</td>";
                    echo "<td> " . $producto['descripcion'] . "</td>";
                    echo "<td> " . $producto['precio'] . "</td>";
                    echo "<td> " . $producto['cantidad'] . "</td>";
                    echo "<td> " . $producto['categoria'] . "</td>";
                    // echo "<td><input type='number' min='0' value='" . getCantidadEnTienda($producto['nombre']) . "' name='cantidad" . $producto['nombre'] . "'></td>";
                    echo "</tr>";
                }
            ?>
        </table>

        <input type="submit" name="submit" value="Comprar" id="boton-comprar">
    </form>
</main>

<div class="centrar">
    <?php
        if($this->data['acl'] === "admin"){
            echo "<div>";
                echo "<a href='VistasAdministrador'>";
                    echo "<button class='actions'>Volver</button>";
                echo "</a>";
            echo "<div>";
        }
    ?>

    <div>
        <a href="LogOut">
            <button class="actions">Cerrar Sesión</button>
        </a>
    </div>
</div>