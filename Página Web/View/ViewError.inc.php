<h1>Error 404</h1>
<main>
    <p class="error">
        No tienes permisos para acceder a esta página o la página que buscas no existe.
    </p>

    <a href="<?= $http->getUrlBase();?>/LogIn" onclick="<?=session_unset(); session_destroy()?>">
        <button class="actions">Volver</button>
    </a>
</main>