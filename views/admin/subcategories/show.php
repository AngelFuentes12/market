    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.js"></script>
    <script src="<?= constant('JS'); ?>tables.js"></script>

    <div id="content" class="container-fluid p-5">
        <section class="py-3">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-12 form-color p-4 shadow-sm">
                        <div class="row mb-3">
                            <div class="col-10">
                                <h4 class="pb-1">Subcategorias</h4>
                            </div>

                            <div class="col-1">
                                <a href="#" class="btn btn-secondary">
                                    <i class="fas fa-file-download"></i>
                                </a>
                            </div>

                            <div class="col-1">
                                <a href="<?= constant('URL'); ?>subcategories" class="btn btn-secondary">
                                    <i class="fas fa-redo-alt"></i>
                                </a>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-xl-12 col-lg-13">
                                <div class="table-responsive">
                                    <table id="dataTable" class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">
                                                    <small class="font-weight-bold">
                                                        Categoria
                                                    </small>
                                                </th>

                                                <th scope="col">
                                                    <small class="font-weight-bold">
                                                        Subcategoria
                                                    </small>
                                                </th>

                                                <th scope="col">
                                                    <small class="font-weight-bold">
                                                        Eliminar
                                                    </small>
                                                </th>

                                                <th scope="col">
                                                    <small class="font-weight-bold">
                                                        Configuraciones
                                                    </small>
                                                </th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php 
                                                require_once 'models/admin/subcategory.php';
                                                foreach ($this->subcategories as $row): 
                                                    $subcategory = new Subcategory();
                                                    $subcategory = $row;
                                            ?>
                                            <tr>
                                                <td>
                                                    <span><?= $subcategory->category; ?></span>
                                                </td>

                                                <td>
                                                    <span><?= $subcategory->subcategory; ?></span>
                                                </td>

                                                <td class="align-middle">
                                                    <a href="<?= constant('URL') . 'subcategories/delete?id=' . $subcategory->id_subcategory; ?>" class="status-span badge-primary badge-delete">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </a>
                                                </td>

                                                <td class="align-middle">
                                                    <a href="<?= constant('URL') . 'subcategories/store?id=' .  $subcategory->id_subcategory; ?>" class="status-span badge-secondary">
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

                        <a href="#" class="status-span badge-primary badge-active" data-toggle="modal" data-target="#exampleModalCenter">
                            <i class="fas fa-plus"></i>
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <div class="modal animate__animated animate__bounceInRight" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title title-register" id="exampleModalLongTitle">
                        <?= $_SESSION['name']; ?>, registra una subcategoria
                    </h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" style="color: red;">&times;</span>
                    </button>
                </div>

                <div class="modal-body mx-auto">
                    <p>
                        Los campos marcados con un <small style="color: red;">*</small> son obligatorios
                    </p>

                    <form method="POST" action="<?= constant('URL'); ?>subcategories/register">
                        <div class="form-group">
                            <label for="category">
                                Categoria <span style="color: red;">*</span>
                            </label>

                            <select id="category" class="form-control <?= $this->error['c1']; ?>" name="id_category" required>
                                <option selected>Seleccionar...</option>
                                <?php 
                                    require_once 'models/admin/category.php';
                                    foreach ($this->categorys as $row): 
                                        $category = new Category();
                                        $category = $row;
                                ?>
                                <option value="<?= $category->id_category; ?>"><?= $category->category; ?></option>
                                <?php endforeach ?>
                            </select>

                            <div class="invalid-feedback">
                                <?= $this->error['m1']; ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="subcategory">Subcategoria <span style="color: red;">*</span>
                            </label>

                            <input id="subcategory" type="text" value="<?= $this->error['subcategory']; ?>" name="subcategory" class="form-control <?= $this->error['c2']; ?>" maxlength="50" minlength="3" required>

                            <div class="invalid-feedback">
                                <?= $this->error['m2']; ?>
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