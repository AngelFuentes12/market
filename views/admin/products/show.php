    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.js"></script>
    <script src="<?= constant('JS'); ?>products.js"></script>
    <script src="<?= constant('JS'); ?>tables.js"></script>

    <div id="content" class="container-fluid py-5">
        <section class="">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-12 form-color p-4 shadow-sm">
                        <div class="row mb-3">
                            <div class="col-11">
                                <h4 class="pb-1">Productos</h4>
                            </div>

                            <div class="col-1">
                                <a href="<?= constant('URL'); ?>products" class="btn btn-secondary">
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
                                                    <small class="font-weight-bold">Subcategoria</small>
                                                </th>

                                                <th scope="col">
                                                    <small class="font-weight-bold">Proveedor</small>
                                                </th>

                                                <th scope="col">
                                                    <small class="font-weight-bold">Contacto</small>
                                                </th>

                                                <th scope="col">
                                                    <small class="font-weight-bold">Producto</small>
                                                </th>

                                                <th scope="col">
                                                    <small class="font-weight-bold">Costo</small>
                                                </th>

                                                <th scope="col">
                                                    <small class="font-weight-bold">Descripcion</small>
                                                </th>

                                                <th scope="col">
                                                    <small class="font-weight-bold">Imagen<small>
                                                </th>

                                                <th scope="col">
                                                    <small class="font-weight-bold">Eliminar<small>
                                                </th>

                                                <th scope="col">
                                                    <small class="font-weight-bold">Opcion<small>
                                                </th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php 
                                                require_once 'models/admin/product.php';
                                                foreach ($this->products as $row): 
                                                    $product = new Product();
                                                    $product = $row;
                                            ?>    
                                            <tr>
                                                <td class="align-middle">
                                                	<span class="d-block">
                                                        <?= $product->subcategory; ?>
                                                    </span>
                                                </td>

                                                <td class="align-middle">
                                                    <span class="d-block">
                                                        <?= $product->vendor; ?>
                                                    </span>
                                                </td>

                                                <td class="align-middle">
                                                    <span class="d-block"><?= $product->name; ?></span>
                                                    <small class="text-muted">
                                                        <?= $product->email1; ?>
                                                    </small>
                                                </td>

                                                <td class="align-middle">
                                                	<span class="d-block">
                                                        <?= $product->product; ?>
                                                    </span>
                                                </td>

                                                <td class="align-middle">
                                                	<span class="d-block">
                                                        $<?= $product->cost; ?>.00
                                                    </span>
                                                </td>

                                                <td class="align-middle">
                                                	<span class="d-block">
                                                        <?= $product->description; ?>
                                                    </span>
                                                </td>

                                                <td class="align-middle">
                                                	<img src="<?= constant('PRO') . $product->image; ?>" alt="<?= $product->product; ?>" class="d-block mx-auto w-100">
                                                </td>

                                                <td class="align-middle">
                                                    <a href="<?= constant('URL'); ?>products/delete?id=<?= $product->id_product; ?>" class="status-span badge-primary badge-delete">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </a>
                                                </td>

                                                <td class="align-middle">
                                                   <a href="<?= constant('URL'); ?>products/store?id=<?= $product->id_product; ?>" class="status-span badge-secondary">
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
                        <?= $_SESSION['name']; ?>, registra un nuevo producto
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
                    <form method="POST" action="<?= constant('URL'); ?>products/register" enctype="multipart/form-data">
                    	<div class="form-group">
                            <label for="category">
                                Categoria <span style="color: red;">*</span>
                            </label>
                            
                            <select id="category" class="form-control <?= $this->error['c1']; ?>" name="id_category" required>
                                <option selected disabled value="">Seleccionar...</option>
                                <?php 
                                    require_once 'models/admin/category.php';
                                    foreach ($this->categories as $row): 
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
                            <label for="subcategory">
                                Subcategoria <span style="color: red;">*</span>
                            </label>

                            <div id="subcategories">
                                <select id="subcategory" class="form-control <?= $this->error['c2']; ?>" name="id_subcategory" required>
                                    <option selected disabled value="">Seleccionar...</option>
                                </select>

                                <div class="invalid-feedback">
                                    <?= $this->error['m2']; ?>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="vendor">
                                Proveedor <span style="color: red;">*</span>
                            </label>
                            
                            <select id="vendor" class="form-control <?= $this->error['c3']; ?>" name="id_vendor" required>
                                <option selected disabled value="">Seleccionar...</option>
                                <?php 
                                    require_once 'models/admin/vendor.php';
                                    foreach ($this->vendors as $row): 
                                        $vendor = new Vendor();
                                        $vendor = $row;
                                ?>
                                <option value="<?= $vendor->id_vendor; ?>">
                                    <?= $vendor->vendor; ?> --- <?= $vendor->name; ?>
                                </option>
                                <?php endforeach ?>
                            </select>

                            <div class="invalid-feedback">
                                <?= $this->error['m3']; ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="product">
                                Nombre del producto <span style="color: red;">*</span>
                            </label>

                            <input id="product" type="text" value="<?= $this->error['product']; ?>" name="product" class="form-control <?= $this->error['c4']; ?>" minlength="3" maxlength="30" required>

                            <div class="invalid-feedback">
                                <?= $this->error['m4']; ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="cost">
                                Costo <span style="color: red;">*</span>
                            </label>

                            <input id="cost" type="text" value="<?= $this->error['cost']; ?>" name="cost" class="form-control <?= $this->error['c5']; ?>" minlength="1" maxlength="5" required>

                            <div class="invalid-feedback">
                                <?= $this->error['m5']; ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="description">
                                Descripcion <span style="color: red;">*</span>
                            </label>

                            <textarea id="description" class="form-control <?= $this->error['c6']; ?>" name="description" required><?= $this->error['description']; ?></textarea>

                            <div class="invalid-feedback">
                                <?= $this->error['m6']; ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="image">
                                Imagen <span style="color: red;">*</span>
                            </label>

                            <input id="image" type="file" class="form-control <?= $this->error['c7']; ?>" name="image" required>

                            <div class="invalid-feedback">
                                <?= $this->error['m7']; ?>
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