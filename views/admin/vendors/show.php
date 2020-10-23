    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.js"></script>
    <script src="<?= constant('JS'); ?>direcctions.js"></script>
    <script src="<?= constant('JS'); ?>tables.js"></script>

    <div id="content" class="container-fluid p-5">
        <section class="py-3">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-12 form-color p-4 shadow-sm">
                        <h4 class="pb-1">Pagína de proveedores</h4>
                        <div class="row mb-3">
                            <div class="col-xl-12 col-lg-12">
                                <div class="table-responsive">
                                    <table id="dataTable" class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">
                                                    <small class="font-weight-bold">Proveedor</small>
                                                </th>

                                                <th scope="col">
                                                    <small class="font-weight-bold">Estatus</small>
                                                </th>

                                                <th scope="col">
                                                    <small class="font-weight-bold">#</small>
                                                </th>

                                                <th scope="col">
                                                    <small class="font-weight-bold">Telefono</small>
                                                </th>

                                                <th scope="col">
                                                    <small class="font-weight-bold">Eliminar<small>
                                                </th>

                                                <th scope="col">
                                                    <small class="font-weight-bold">Configuración<small>
                                                </th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <tr>
                                                <td>
                                                    <span class="d-block">Danile H.</span>
                                                    <small class="text-muted">daniela@motorola.com</small>
                                                </td>

                                                <td class="align-middle">
                                                    <span class="status-span badge-primary badge-active">
                                                        Activo
                                                    </span>
                                                </td>

                                                <td class="align-middle">
                                                    <a href="#" class="status-span badge-primary badge-activo">
                                                        <i class="fas fa-arrow-down"></i>
                                                    </a>
                                                </td>

                                                <td class="align-middle">
                                                    <a href="#" class="status-span badge-secondary text-secondary">
                                                        5545343673
                                                    </a>
                                                </td>

                                                <td class="align-middle">
                                                    <a href="#" class="status-span badge-primary badge-delete">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </a>
                                                </td>

                                                <td class="align-middle">
                                                    <a href="#" class="status-span badge-secondary">
                                                        Editar <i class="fas fa-cog"></i>
                                                    </a>
                                                </td>
                                            </tr>

                                            <tr class="">
                                                <td><span class="d-block">Andrea S.</span><small class="text-muted">andrea@samsung.com</small></td>
                                                <td class="align-middle"><span class="status-span badge-primary badge-delete">desactivado</span></td>
                                                <td class="align-middle"><a href="#" class="status-span badge-primary badge-active"><i class="fas fa-arrow-up"></i></a></td>
                                                <td class="align-middle"><a href="#" class="status-span badge-secondary text-secondary">5545343673</a></td>
                                                <td class="align-middle"><a href="#" class="status-span badge-primary badge-delete"><i class="fas fa-trash-alt"></i></a></td>
                                                <td class="align-middle"><a href="#" class="status-span badge-secondary">Editar <i class="fas fa-cog"></i></a></td>
                                            </tr>
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
    <div class="modal animate__animated animate__bounceInRight" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title title-register" id="exampleModalLongTitle">
                        <?= $_SESSION['name']; ?>, registra un nuevo proveedor
                    </h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" style="color: red;">&times;</span>
                    </button>
                </div>
                <!--  -->
                <div class="modal-body mx-auto">
                    <p>
                        Los campos marcados con un <small style="color: red;">*</small> son obligatorios
                    </p>
                    <form method="POST" action="">
                        <div class="form-group">
                            <label for="name">
                                Nombre <span style="color: red;">*</span>
                            </label>

                            <input id="name" type="text" value="<?= $this->error['name']; ?>" name="name" class="form-control <?= $this->error['c1']; ?>" required>

                            <div class="invalid-feedback">
                                <?= $this->error['m1']; ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email">
                                Correo Electronico <span style="color: red;">*</span>
                            </label>

                            <input id="email" type="email" value="<?= $this->error['email']; ?>" name="email" class="form-control <?= $this->error['c2']; ?>" required>

                            <div class="invalid-feedback">
                                <?= $this->error['m2']; ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email2">
                                Correo Electronico opcional
                            </label>

                            <input id="email2" type="email" value="<?= $this->error['email2']; ?>" name="email2" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="telephone">
                                Telefono <span style="color: red;">*</span>
                            </label>

                            <input id="telephone" type="text" value="<?= $this->error['telephone']; ?>" name="telephone" class="form-control <?= $this->error['c3']; ?>" required>

                            <div class="invalid-feedback">
                                <?= $this->error['m3']; ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="telephone2">
                                Telefono opcional
                            </label>

                            <input id="telephone2" type="text" value="<?= $this->error['telephone2']; ?>" name="telephone2" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="state">
                                Estado <span style="color: red;">*</span>
                            </label>
                            
                            <select id="state" class="form-control <?= $this->error['c4']; ?>" name="id_state" required>
                                <option selected>Seleccionar...</option>
                                <?php 
                                    require_once 'models/admin/state.php';
                                    foreach ($this->states as $row): 
                                        $state = new State();
                                        $state = $row;
                                ?>
                                <option value="<?= $state->id_state; ?>"><?= $state->state; ?></option>
                                <?php endforeach ?>
                            </select>

                            <div class="invalid-feedback">
                                <?= $this->error['m4']; ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="municipality">
                                Municipio <span style="color: red;">*</span>
                            </label>

                            <div id="municipalities">
                                <select id="municipality" class="form-control <?= $this->error['c5']; ?>" name="id_municipality" required>
                                    <option selected>Seleccionar...</option>
                                </select>
                            </div>

                            <div class="invalid-feedback">
                                <?= $this->error['m5']; ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="colony">
                                Colonia <span style="color: red;">*</span>
                            </label>

                            <div id="colonies">
                                <select id="colony" class="form-control <?= $this->error['c6']; ?>" name="id_colony" required>
                                    <option selected>Seleccionar...</option>
                                </select>
                            </div>

                            <div class="invalid-feedback">
                                <?= $this->error['m6']; ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="postcode">
                                Codigo postal <span style="color: red;">*</span>
                            </label>

                            <div id="postcodes">
                                <select id="postcode" class="form-control <?= $this->error['c7']; ?>" name="id_postcode" required>
                                    <option selected>Seleccionar...</option>
                                </select>
                            </div>

                            <div class="invalid-feedback">
                                <?= $this->error['m7']; ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="street">
                                Calle <span style="color: red;">*</span>
                            </label>

                            <input id="street" type="text" value="<?= $this->error['street']; ?>" name="street" class="form-control <?= $this->error['c8']; ?>" required>

                            <div class="invalid-feedback">
                                <?= $this->error['m8']; ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inside">
                                Número Interior <span style="color: red;">*</span>
                            </label>

                            <input id="inside" type="text" value="<?= $this->error['inside']; ?>" name="inside" class="form-control <?= $this->error['c9']; ?>" required>

                            <div class="invalid-feedback">
                                <?= $this->error['m9']; ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="outside">
                                Número Exterior <span style="color: red;">*</span>
                            </label>

                            <input id="outside" type="text" value="<?= $this->error['outside']; ?>" name="outside" class="form-control <?= $this->error['c9']; ?>" required>

                            <div class="invalid-feedback">
                                <?= $this->error['m9']; ?>
                            </div>
                        </div>

                        <div class="mx-auto pb-5">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-info">Registrar</button>
                        </div>
                    </form>
                </div>    
            </div>
        </div>
    </div>