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
                                <h4 class="pb-1">Almacen</h4>
                            </div>

                            <div class="col-1">
                                <a href="<?= constant('URL'); ?>store" class="btn btn-secondary">
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
                                                    <small class="font-weight-bold">Producto</small>
                                                </th>

                                                <th scope="col">
                                                    <small class="font-weight-bold">Costo</small>
                                                </th>

                                                <th scope="col">
                                                    <small class="font-weight-bold">Existencia</small>
                                                </th>

                                                <th scope="col">
                                                    <small class="font-weight-bold">Ultimo ingreso de existencia</small>
                                                </th>

                                                <th scope="col">
                                                    <small class="font-weight-bold">Imagen<small>
                                                </th>

                                                <th scope="col">
                                                    <small class="font-weight-bold">Agregar<small>
                                                </th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php 
                                                require_once 'models/admin/store.php';
                                                foreach ($this->stores as $row): 
                                                    $store = new Store();
                                                    $store = $row;
                                            ?>    
                                            <tr>
                                            	<td class="align-middle">
                                                	<span class="d-block">
                                                        <?= $store->subcategory; ?>
                                                    </span>
                                                </td>

                                                <td class="align-middle">
                                                	<span class="d-block">
                                                        <?= $store->product; ?>
                                                    </span>
                                                </td>

                                                <td class="align-middle">
                                                	<span class="d-block">
                                                        $<?= $store->cost; ?>.00
                                                    </span>
                                                </td>

                                                <td class="align-middle">
                                                	<span class="d-block">
                                                        <?= $store->amount; ?>
                                                    </span>
                                                </td>

                                                <td class="align-middle">
                                                	<span class="d-block">
                                                        <?= $store->date_entry; ?>
                                                    </span>
                                                </td>

                                                <td class="align-middle">
                                                	<img src="<?= constant('PRO') . $store->image; ?>" alt="<?= $store->product; ?>" class="d-block mx-auto w-50">
                                                </td>

                                                <td class="align-middle">
                                                   <a href="<?= constant('URL'); ?>store/add?id=<?= $store->id_product; ?>" class="status-span badge-success">
                                                        <i class="fas fa-plus"></i>
                                                    </a>
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

<!-- validación -->

<script src="<?= constant('JS'); ?>validations.js"></script>