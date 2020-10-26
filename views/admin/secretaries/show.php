    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.js"></script>
    <script src="<?= constant('JS'); ?>tables.js"></script>

    <div id="content" class="container-fluid py-5">
        <section class="">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-12 form-color p-4 shadow-sm">
                        <div class="row mb-3">
                            <div class="col-10">
                                <h4 class="pb-1">Secretarias</h4>
                            </div>

                            <div class="col-1">
                                <a href="#" class="btn btn-secondary">
                                    <i class="fas fa-file-download"></i>
                                </a>
                            </div>

                            <div class="col-1">
                                <a href="<?= constant('URL'); ?>secretaries" class="btn btn-secondary">
                                    <i class="fas fa-redo-alt"></i>
                                </a>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-xl-12 col-lg-12">
                                <div class="table-responsive">
                                    <table id="dataTable" class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">
                                                    <small class="font-weight-bold">Secretaria</small>
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
                                            require_once 'models/admin/secretary.php';
                                            foreach ($this->secretaries as $row) :
                                                $secretary = new Secretary();
                                                $secretary = $row;
                                            ?>
                                                <tr>
                                                    <td><span class="d-block"><?= $secretary->name; ?></span>
                                                        <small class="text-muted">
                                                            <?= $secretary->email; ?>
                                                        </small>
                                                    </td>

                                                    <td class="align-middle">
                                                        <?php if ($secretary->status == 1) : ?>
                                                            <span class="status-span badge-primary badge-active">
                                                                Activo
                                                            </span>
                                                        <?php elseif ($secretary->status == 2) : ?>
                                                            <span class="status-span badge-primary badge-active">
                                                                Verificación
                                                            </span>
                                                        <?php elseif ($secretary->status == 3) : ?>
                                                            <span class="status-span badge-primary badge-delete">
                                                                Desactivado
                                                            </span>
                                                        <?php endif ?>
                                                    </td>

                                                    <td class="align-middle">
                                                        <?php if (isset($_SESSION['secretary']) && $_SESSION['secretary'] != $secretary->id_user || isset($_SESSION['admin'])) : ?>
                                                            <?php if ($secretary->status == 1) : ?>
                                                                <a href="<?= constant('URL'); ?>secretaries/status?id=<?= $secretary->id_user; ?>&status=3" class="status-span badge-primary badge-activo">
                                                                    <i class="fas fa-arrow-down"></i>
                                                                </a>
                                                            <?php elseif ($secretary->status == 3) : ?>
                                                                <a href="<?= constant('URL'); ?>secretaries/status?id=<?= $secretary->id_user; ?>&status=1" class="status-span badge-primary badge-active">
                                                                    <i class="fas fa-arrow-up"></i>
                                                                </a>
                                                            <?php endif ?>
                                                        <?php endif ?>
                                                    </td>

                                                    <td class="align-middle">
                                                        <?php if (isset($_SESSION['secretary']) && $_SESSION['secretary'] != $secretary->id_user || isset($_SESSION['admin'])) : ?>
                                                            <a href="<?= constant('URL'); ?>secretaries/delete?id=<?= $secretary->id_user; ?>" class="status-span badge-primary badge-delete">
                                                                <i class="fas fa-trash-alt"></i>
                                                            </a>
                                                        <?php endif ?>
                                                    </td>

                                                    <td class="align-middle">
                                                        <a href="<?= constant('URL'); ?>secretaries/store?id=<?= $secretary->id_user; ?>" class="status-span badge-secondary">
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


    <!-- Modal registro secretary-->
    <div class="modal animate__animated animate__bounceInLeft" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title title-register" id="exampleModalLongTitle"><?= $_SESSION['name']; ?>, registra a un nuev@ secretaria</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" style="color: red;">&times;</span>
                    </button>
                </div>
                <div class="modal-body mx-auto">
                    <p class="">Los campos marcados con un <small style="color: red;">*</small> son obligatorios</p>
                    <!-- <div class="col-12 col-md-10 form-color p-4 "> -->
                    <form method="POST" action="<?= constant('URL'); ?>secretaries/register">
                        <div class="form-group">
                            <label for="name" class="name">Nombre <span style="color: red;">*</span></label>

                            <input type="text" value="<?= $this->error['name']?>" name="name" class="form-control <?= $this->error['c1']; ?>" required>

                            <div class="invalid-feedback">
                                <?= $this->error['m1']; ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="email">Correo Electronico <span style="color: red;">*</span></label>

                            <input type="email" value="<?= $this->error['email']; ?>" name="email" class="form-control <?= $this->error['c2']; ?>" required>

                            <div class="invalid-feedback">
                                <?= $this->error['m2']; ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password" class="password">Contraseña <span style="color: red;">*</span></label>

                            <input type="password" name="password" value="<?= $this->error['password']; ?>" class="form-control <?= $this->error['c3']; ?>" required>

                            <div class="invalid-feedback">
                                <?= $this->error['m3']; ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="confpassword" class="confpassword">Escribe nuevamente tu contraseña <span style="color: red;">*</span></label>

                            <input type="password" name="confirmpassword" class="form-control <?= $this->error['c4']; ?>" required>

                            <div class="invalid-feedback">
                                <?= $this->error['m4']; ?>
                            </div>
                        </div>
                        <div class="mx-auto pb-5 center-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-info">Registrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>