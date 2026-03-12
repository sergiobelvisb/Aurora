<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Aurora EEG</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Fuentes -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Space+Grotesk:wght@500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- CSS global -->
    <link href="<?=$http->getUrlBase()?>/public/css/global.css" rel="stylesheet">

    <!-- CSS personal-->
    <?=$data['extraCSS'] ?? "" ?>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light">
    <div class="container">
        <a class="navbar-brand" href="<?=$http->getUrlBase()?>">
        <img src="<?=$http->getUrlBase()?>/public/img/Nombre.png" alt="Aurora EEG" height="50">
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
        <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent"> <br>
            <div class="navbar-nav ms-auto align-items-center">
                <a class="nav-link" href="<?=$http->getUrlBase()?>/Tecnologia">Tecnología</a>
                <a class="nav-link" href="<?=$http->getUrlBase()?>/Profesionales">Profesionales</a>
                <?php if(isset($_SESSION['id'])): ?>
                    <?php if($_SESSION['id'] === 'Administrador'): ?>
                        <a class="nav-link" href="<?=$http->getUrlBase()?>/VistaAdmin">Vista Admin</a>
                    <?php endif; ?>
                <a class="nav-link" href="<?=$http->getUrlBase()?>/PanelControl">Panel de Control</a>
                <div class="dropdown">
                    <a class="nav-link profile-btn dropdown-toggle d-flex align-items-center" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="<?=$http->getUrlBase()?>/public/img/pfp/default.png" class="profile-img me-2" alt="Foto perfil">
                        <span><?=$http->getResponse()->getSession()->get('nombreCompleto')?></span>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="<?=$http->getUrlBase()?>/Perfil">Configurar Perfil</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item text-danger" href="<?=$http->getUrlBase()?>/LogOut">Cerrar sesión</a>
                        </li>
                    </ul>
                </div>
                <?php else: ?>
                    <a class="nav-link" href="<?=$http->getUrlBase()?>/Login">Acceso</a>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <?=$data['extraJS'] ?? "" ?>
    </nav>

    <div>