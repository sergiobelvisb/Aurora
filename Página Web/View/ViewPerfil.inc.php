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
                            <img src="<?=$http->getUrlBase().$data['userData']['image'].'?t='.time()?>" class="profile-img-large mb-3">

                            <br>

                            <form action="<?=$http->getUrlBase()?>/Perfil/cambiarFoto" method="post" enctype="multipart/form-data">
                                <input type="file" id="Foto" name="Foto" accept=".png" onchange="this.form.submit()" hidden>

                                <label for="Foto" class="btn btn-outline-primary btn-sm">
                                    Cambiar Foto
                                </label>
                            </form>
                        </div>

                        <?php foreach($data['camposEditables'] as $campo => $config): ?>
                            <div class="profile-field">
                                <div>
                                    <strong><?=$config['label']?></strong><br>
                                    <?php   
                                        if($campo === 'password'){
                                            echo '*******';
                                        } else {
                                            echo $data['userData'][$campo];
                                        }
                                    
                                    ?>
                                </div>

                                <a href="<?=$http->getUrlBase().$config['action']?>" class="btn btn-outline-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#modalEditar-<?=$campo?>">
                                    Editar
                                </a>

                                <!-- Modal específico para este campo -->
                                <div class="modal fade" id="modalEditar-<?=$campo?>" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">

                                            <div class="modal-header">
                                                <h5 class="modal-title">Editar <?=$config['label']?></h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>

                                            <form action="<?=$http->getUrlBase().$config['action']?>" method="POST">

                                                <div class="modal-body">
                                                    <?php if($campo === 'password'): ?>
                                                        <!-- PASSWORD -->
                                                        <div class="mb-3">
                                                            <label>Contraseña actual</label>
                                                            <input type="password" name="current_password" class="form-control" required>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label>Nueva contraseña</label>
                                                            <input type="password" name="new_password" class="form-control" required>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label>Repetir nueva contraseña</label>
                                                            <input type="password" name="repeat_password" class="form-control" required>
                                                        </div>

                                                    <?php elseif($campo === 'hospital'): ?>

                                                        <!-- HOSPITAL -->
                                                        <select name="hospitalID" class="form-control">
                                                            <?php foreach ($data['hospitales'] as $hospital): ?>
                                                                <option value="<?= $hospital['hospitalID'] ?>" <?= $hospital['nombre'] == $data['userData']['hospital'] ? 'selected' : ''?>>
                                                                    <?= $hospital['nombre'] ?>
                                                                </option>
                                                            <?php endforeach; ?>
                                                        </select>

                                                    <?php else: ?>

                                                        <!-- RESTO -->
                                                        <div class="mb-3">
                                                            <label><?=$config['label']?></label>
                                                            <input type="<?=$config['type']?>" 
                                                                name="<?=$campo?>" 
                                                                class="form-control" 
                                                                value="<?=htmlspecialchars($data['userData'][$campo])?>" 
                                                                required>
                                                        </div>

                                                    <?php endif; ?>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Volver</button>
                                                    <button type="submit" class="btn btn-primary">Guardar cambios</button>
                                                </div>

                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>

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