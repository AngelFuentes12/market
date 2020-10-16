    <div id="content" class="container-fluid p-5">
        <section class="py-3">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-12 form-color p-4 shadow-sm">
                        <h4 class="pb-1">Pagína de administradores</h4>
                        <div class="row mb-3">
                            <div class="col-xl-12 col-lg-12">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">
                                                    <small class="font-weight-bold">Administrador</small>
                                                </th>

                                                <th scope="col">
                                                    <small class="font-weight-bold">Estatus</small>
                                                </th>

                                                <th scope="col">
                                                    <small class="font-weight-bold">Opcion</small>
                                                </th>

                                                <th scope="col">
                                                    <small class="font-weight-bold">Eliminar</small>
                                                </th>

                                                <th scope="col">
                                                    <small class="font-weight-bold">Configuración</small>
                                                </th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php
                                            require_once 'models/admin/admin.php';
                                            foreach ($this->admins as $row) :
                                                $admin = new Admin();
                                                $admin = $row;
                                            ?>
                                                <tr>
                                                    <td><span class="d-block"><?= $admin->name; ?></span>
                                                        <small class="text-muted">
                                                            <?= $admin->email; ?>
                                                        </small>
                                                    </td>

                                                    <td class="align-middle">
                                                        <?php if ($admin->status == 1) : ?>
                                                            <span class="status-span badge-primary badge-active">
                                                                Activo
                                                            </span>
                                                        <?php elseif ($admin->status == 2) : ?>
                                                            <span class="status-span badge-primary badge-active">
                                                                Verificación
                                                            </span>
                                                        <?php elseif ($admin->status == 3) : ?>
                                                            <span class="status-span badge-primary badge-delete">
                                                                Desactivado
                                                            </span>
                                                        <?php endif ?>
                                                    </td>

                                                    <td class="align-middle">
                                                        <?php if (isset($_SESSION['admin']) && $_SESSION['admin'] != $admin->id_user || isset($_SESSION['secretary'])) : ?>
                                                            <?php if ($admin->status == 1) : ?>
                                                                <a href="<?= constant('URL'); ?>admins/status?id=<?= $admin->id_user; ?>&status=3" class="status-span badge-primary badge-activo">
                                                                    <i class="fas fa-arrow-down"></i>
                                                                </a>
                                                            <?php elseif ($admin->status == 3) : ?>
                                                                <a href="<?= constant('URL'); ?>admins/status?id=<?= $admin->id_user; ?>&status=1" class="status-span badge-primary badge-active">
                                                                    <i class="fas fa-arrow-up"></i>
                                                                </a>
                                                            <?php endif ?>
                                                        <?php endif ?>
                                                    </td>

                                                    <td class="align-middle">
                                                        <?php if (isset($_SESSION['admin']) && $_SESSION['admin'] != $admin->id_user || isset($_SESSION['secretary'])) : ?>
                                                            <a href="<?= constant('URL'); ?>admins/delete?id=<?= $admin->id_user; ?>" class="status-span badge-primary badge-delete">
                                                                <i class="fas fa-trash-alt"></i>
                                                            </a>
                                                        <?php endif ?>
                                                    </td>

                                                    <td class="align-middle">
                                                        <a href="<?= constant('URL'); ?>admins/edit?id=<?= $admin->id_user; ?>" class="status-span badge-secondary">
                                                            Editar <i class="fas fa-cog"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            <?php endforeach ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <a href="#" class="status-span badge-primary text-primary" data-toggle="modal" data-target="#exampleModalCenter">
                            Nuevo <i class="fas fa-user-plus"></i>
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </div>


    <!-- Modal registro admin-->
    <div class="modal animate__animated animate__bounceInLeft" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title title-register" id="exampleModalLongTitle">Alberto, registra a un nuevo admin</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" style="color: red;">&times;</span>
                    </button>
                </div>
                <div class="modal-body mx-auto">
                    <p class="">Los campos marcados con un <small style="color: red;">*</small> son obligatorios</p>
                    <!-- <div class="col-12 col-md-10 form-color p-4 "> -->
                    <form method="POST" action="">
                        <div class="form-group">
                            <label for="name" class="name">Nombre <span style="color: red;">*</span></label>
                            <input type="text" value="" name="name" class="form-control" required>
                            <div class="invalid-feedback">

                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="email">Correo Electronico <span style="color: red;">*</span></label>
                            <input type="email" value="" name="email" class="form-control" required>
                            <div class="invalid-feedback">

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password" class="password">Contraseña <span style="color: red;">*</span></label>
                            <input type="password" name="password" class="form-control" required>
                            <div class="invalid-feedback">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="confpassword" class="confpassword">Escribe nevamente tu contraseña <span style="color: red;">*</span></label>
                            <input type="password" name="confpassword" class="form-control" required>
                            <div class="invalid-feedback">
                            </div>
                        </div>

                    </form>
                </div>
                <div class="mx-auto pb-5">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-info">Registrar</button>
                </div>
            </div>
        </div>
    </div>