<h1>Administrar Usuarios</h1>

<main>
    <table>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Password</th>
            <th>ACL</th>
        </tr>

        <?php
            foreach ($this->data['usuarios'] as $reg) {
                echo "<tr>";
                echo "<td>{$reg['id']}</td>";
                echo "<td><a href='".$http->getUrlBase()."/AdminUsuarios/Usuario/{$reg['id']}'>{$reg['username']}</a></td>";
                echo "<td>{$reg['password']}</td>";
                echo "<td>{$reg['acl']}</td>";
                echo "</tr>";
            }
        ?>
    </table>

    <div>
        <a href="<?= $http->getUrlBase();?>/VistasAdministrador">
            <button class="actions">Volver</button>
        </a>
    </div>
</main>
