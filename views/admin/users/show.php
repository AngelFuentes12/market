    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.js"></script>
    <script src="<?= constant('JS'); ?>tables.js"></script>

    <div id="content" class="container-fluid py-5">
        <section class="">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-12 form-color p-4 shadow-sm">
                        <div class="row mb-3">
                            <div class="col-11">
                                <h4 class="pb-1">Clientes</h4>
                            </div>

                            <div class="col-1">
                                <a href="<?= constant('URL'); ?>users" class="btn btn-secondary">
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
                                                    <small class="font-weight-bold">Nombre</small>
                                                </th>

                                                <th>
                                                    <small class="font-weight-bold" >RFC</small>
                                                </th>

                                                <th scope="col">
                                                    <small class="font-weight-bold">Estatus</small>
                                                </th>

                                                <th scope="col">
                                                    <small class="font-weight-bold">Opcion</small>
                                                </th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php 
                                                require_once 'models/admin/user.php';
                                                foreach ($this->users as $row):
                                                    $user = new User(); 
                                                    $user = $row;
                                            ?>
                                            <tr>
                                                <td>
                                                    <span class="d-block"><?= $user->name; ?></span>
                                                    <small class="text-muted"><?= $user->email; ?></small>
                                                </td>

                                                <td class="align-middle">
                                                    <span class="d-block"><?= $user->rfc; ?></span>
                                                </td>

                                                <td class="align-middle">
                                                <?php if ($user->status == 1) : ?>
                                                    <span class="status-span badge-primary badge-active">
                                                        Activo
                                                    </span>
                                                <?php elseif ($user->status == 2) : ?>
                                                    <span class="status-span badge-primary badge-active">
                                                        Verificación
                                                    </span>
                                                <?php elseif ($user->status == 3) : ?>
                                                    <span class="status-span badge-primary badge-delete">
                                                        Desactivado
                                                    </span>
                                                <?php endif ?>
                                                </td>

                                                <td class="align-middle">
                                                <?php if ($user->status == 1) : ?>
                                                    <a href="<?= constant('URL'); ?>users/status?id=<?= $user->id_user; ?>&status=3" class="status-span badge-primary badge-activo">
                                                        <i class="fas fa-arrow-down"></i>
                                                    </a>
                                                <?php elseif ($user->status == 3) : ?>
                                                    <a href="<?= constant('URL'); ?>users/status?id=<?= $user->id_user; ?>&status=1" class="status-span badge-primary badge-active">
                                                        <i class="fas fa-arrow-up"></i>
                                                    </a>
                                                <?php endif ?>
                                                </td>
                                            </tr>
                                            <?php endforeach ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>