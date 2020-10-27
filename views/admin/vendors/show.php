    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.js"></script>
    <script src="<?= constant('JS'); ?>direcctions.js"></script>
    <script src="<?= constant('JS'); ?>tables.js"></script>

    <div id="content" class="container-fluid py-5">
        <section class="">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-12 form-color p-4 shadow-sm">
                        <div class="row mb-3">
                            <div class="col-11">
                                <h4 class="pb-1">Proveedores</h4>
                            </div>

                            <div class="col-1">
                                <a href="<?= constant('URL'); ?>vendors" class="btn btn-secondary">
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
                                                    <small class="font-weight-bold">Proveedor</small>
                                                </th>

                                                <th scope="col">
                                                    <small class="font-weight-bold">Nombre</small>
                                                </th>

                                                <th scope="col">
                                                    <small class="font-weight-bold">Telefonos</small>
                                                </th>

                                                <th scope="col">
                                                    <small class="font-weight-bold">Direccion</small>
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
                                            <?php 
                                                require_once 'models/admin/vendor.php';
                                                foreach ($this->vendors as $row):
                                                    $vendor = new Vendor();
                                                    $vendor = $row; 
                                            ?>
                                            <tr>
                                                <td>
                                                    <span class="d-block"><?= $vendor->vendor; ?></span>
                                                </td>

                                                <td>
                                                    <span class="d-block"><?= $vendor->name; ?></span>
                                                    <small class="text-muted">
                                                        <?= $vendor->email1; ?>
                                                    </small>

                                                    <?php if ($vendor->email2 != ''): ?>
                                                    <small class="text-muted">
                                                        <?= $vendor->email2; ?>
                                                    </small>    
                                                    <?php endif ?>
                                                </td>

                                                <td class="align-middle">
                                                    <p class="status-span badge-secondary text-secondary">
                                                        <?= $vendor->telephone1; ?>
                                                    </p>
                                                    <?php if ($vendor->telephone2 != ''): ?>
                                                    <p class="status-span badge-secondary text-secondary">
                                                        <?= $vendor->telephone2; ?>
                                                    </p>    
                                                    <?php endif ?>
                                                </td>

                                                <td class="align-middle">
                                                    <span class="d-block">
                                                        <?= $vendor->direcction; ?>
                                                    </span>
                                                </td>

                                                <td class="align-middle">
                                                    <a href="<?= constant('URL'); ?>vendors/delete?id=<?= $vendor->id_vendor; ?>" class="status-span badge-primary badge-delete">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </a>
                                                </td>

                                                <td class="align-middle">
                                                    <a href="<?= constant('URL'); ?>vendors/store?id=<?= $vendor->id_vendor; ?>" class="status-span badge-secondary">
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
                    <form method="POST" action="<?= constant('URL'); ?>vendors/register">
                        <div class="form-group">
                            <label for="vendor">
                                Proveedor <span style="color: red;">*</span>
                            </label>

                            <input id="vendor" type="text" value="<?= $this->error['vendor']; ?>" name="vendor" class="form-control <?= $this->error['c11']; ?>" minlength="3" maxlength="30" required>

                            <div class="invalid-feedback">
                                <?= $this->error['m11']; ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name">
                                Nombre <span style="color: red;">*</span>
                            </label>

                            <input id="name" type="text" value="<?= $this->error['name']; ?>" name="name" class="form-control <?= $this->error['c1']; ?>" minlength="3" maxlength="30" required>

                            <div class="invalid-feedback">
                                <?= $this->error['m1']; ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email">Correo Electronico <span style="color: red;">*</span></label>

                            <span class="hint--right hint--rounded hint--info hint--large" style="cursor: pointer;" 
                            aria-label="Si tienes 2 correos electronicos, ingresa ambos colocando una coma por ejemplo: correo@correo.com,correo@correo.com">
                                <i class="fas fa-info-circle"></i>
                            </span>

                            <input id="email" type="text" value="<?= $this->error['email']; ?>" name="email" class="form-control <?= $this->error['c2']; ?>" maxlength="40" required>

                            <div class="invalid-feedback">
                                <?= $this->error['m2']; ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="telephone">Telefono <span style="color: red;">*</span></label>

                            <span class="hint--right hint--rounded hint--info hint--large" style="cursor: pointer;" 
                            aria-label="Si tienes 2 Telefonos Ingresa ambos colcando una coma por ejemplo: 554 6754 123,554 6754 123 ">
                                <i class="fas fa-info-circle"></i>
                            </span>

                            <input id="telephone" type="text" value="<?= $this->error['telephone']; ?>" name="telephone" class="form-control <?= $this->error['c3']; ?>" minlength="10" maxlength="22" required>

                            <div class="invalid-feedback">
                                <?= $this->error['m3']; ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="state">
                                Estado <span style="color: red;">*</span>
                            </label>
                            
                            <select id="state" class="form-control <?= $this->error['c4']; ?>" name="id_state" required>
                                <option selected disabled value="">Seleccionar...</option>
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
                                    <option selected disabled value="">Seleccionar...</option>
                                </select>

                                <div class="invalid-feedback">
                                    <?= $this->error['m5']; ?>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="colony">
                                Colonia <span style="color: red;">*</span>
                            </label>

                            <div id="colonies">
                                <select id="colony" class="form-control <?= $this->error['c6']; ?>" name="id_colony" required>
                                    <option selected disabled value="">Seleccionar...</option>
                                </select>

                                <div class="invalid-feedback">
                                    <?= $this->error['m6']; ?>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="postcode">
                                Codigo postal <span style="color: red;">*</span>
                            </label>

                            <div id="postcodes">
                                <select id="postcode" class="form-control <?= $this->error['c7']; ?>" name="id_postcode" required>
                                    <option selected disabled value="">Seleccionar...</option>
                                </select>

                                <div class="invalid-feedback">
                                    <?= $this->error['m7']; ?>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="street">
                                Calle <span style="color: red;">*</span>
                            </label>

                            <input id="street" type="text" value="<?= $this->error['street']; ?>" name="street" class="form-control <?= $this->error['c8']; ?>" minlength="5" maxlength="30" required>

                            <div class="invalid-feedback">
                                <?= $this->error['m8']; ?>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="inside">
                                Número Interior <span style="color: red;">*</span>
                            </label>

                            <input id="inside" type="text" value="<?= $this->error['inside']; ?>" name="inside" class="form-control <?= $this->error['c9']; ?>" minlength="1" maxlength="4" required>

                            <div class="invalid-feedback">
                                <?= $this->error['m9']; ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="outside">
                                Número Exterior <span style="color: red;">*</span>
                            </label>

                            <input id="outside" type="text" value="<?= $this->error['outside']; ?>" name="outside" class="form-control <?= $this->error['c9']; ?>" minlength="1" maxlength="4" required>

                            <div class="invalid-feedback">
                                <?= $this->error['m9']; ?>
                            </div>
                        </div>

                        <div class="mx-auto pb-5">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">
                                Cancelar
                            </button>

                            <button type="submit" class="btn btn-info">Registrar</button>
                        </div>
                    </form>
                </div>    
            </div>
        </div>
    </div>