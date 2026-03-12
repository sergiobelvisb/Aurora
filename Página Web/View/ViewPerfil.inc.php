<section class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-sm">
                    <div class="card-header text-center">
                        <h3>Perfil de Usuario</h3>
                    </div>

                    <div class="card-body">
                        <div class="text-center mb-4">
                            <img src="<?=$http->getUrlBase()?>/public/img/pfp/default.png" class="profile-img-large mb-3">

                            <br>

                            <a href="<?=$http->getUrlBase()?>/Perfil/cambiarFoto" class="btn btn-outline-primary btn-sm">
                                Cambiar foto
                            </a>
                        </div>
                        <div class="profile-field">
                            <div>
                                <strong>Nombre completo</strong><br>
                                <?=$data['userData']['nombreCompleto']?>
                            </div>

                            <a href="<?=$http->getUrlBase()?>/Perfil/editarNombre" class="btn btn-outline-secondary btn-sm">
                                Editar
                            </a>
                        </div>
                        <div class="profile-field">
                            <div>
                                <strong>Email</strong><br>
                                <?=$data['userData']['email']?>
                            </div>

                            <a href="<?=$http->getUrlBase()?>/Perfil/editarEmail" class="btn btn-outline-secondary btn-sm">
                                Editar
                            </a>
                        </div>
                        <div class="profile-field">
                            <div>
                                <strong>Hospital</strong><br>
                                <?=$data['userData']['hospital']?>
                            </div>

                            <a href="<?=$http->getUrlBase()?>/Perfil/editarHospital" class="btn btn-outline-secondary btn-sm">
                                Editar
                            </a>
                        </div>
                        <div class="profile-field">
                            <div>
                                <strong>Contraseña</strong><br>
                                ************
                            </div>

                            <a href="<?=$http->getUrlBase()?>/Perfil/cambiarPassword" class="btn btn-outline-secondary btn-sm">
                                Cambiar
                            </a>
                        </div>
                        <div class="profile-field">
                            <div>
                                <strong>Rol</strong><br>
                                <?=$data['userData']['acl']?>
                            </div>
                        </div>
                        <div class="text-center mt-4">
                            <a href="<?=$http->getUrlBase()?>" class="btn btn-outline-danger btn-sm">
                                Volver
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>