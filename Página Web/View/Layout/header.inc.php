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
        <a class="navbar-brand" href="#">
        <img src="<?=$http->getUrlBase()?>/public/img/Nombre.png" alt="Aurora EEG" height="50">
        </a>

        <!-- Botón hamburguesa -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
        <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent"> <br>
            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="#">Tecnología</a>
                <a class="nav-link" href="#">Profesionales</a>
                <a class="nav-link" href="Login">Acceso</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    </nav>

    <div>