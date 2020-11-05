    <div id="content" class="container-fluid py-5">
        <section>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-7 form-color p-4 shadow-sm">
                        <h4 class="pb-1">Subir slider</h4>

                        <form method="POST" enctype="multipart/form-data" action="<?= constant('URL'); ?>slider/register" class="py-3">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            Subir
                                        </span>
                                    </div>

                                    <div class="custom-file">
                                        <input type="file" name="slider" class="custom-file-input <?= $this->error['c1']; ?>">

                                        <label class="custom-file-label text-file" for="files">
                                            Elegir <span style="color: red;">*</span>
                                        </label>

                                        <div class="invalid-feedback">
                                            <?= $this->error['m1']; ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-3 mx-auto">
                                    <input type="submit" class="btn btn-info" value="Registrar">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <section id="tabla-imaganes" class="py-3">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-10 form-color p-4 shadow-sm">
                        <h4 class="pb-1">Imaganes guardadas</h4>

                        <div class="row mb-3">
                            <div class="col-xl-12 col-lg-12">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">
                                                    <small class="font-weight-bold">ID<small>
                                                </th>

                                                <th scope="col">
                                                    <small class="font-weight-bold">Nombre<small>
                                                </th>
                                                        
                                                <th scope="col">
                                                    <small class="font-weight-bold">Status<small>
                                                </th>

                                                <th scope="col">
                                                    <small class="font-weight-bold">#<small>
                                                </th>

                                                <th scope="col">
                                                    <small class="font-weight-bold">Eliminar<small>
                                                </th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php 
                                                require_once 'models/admin/sliders.php';
                                                foreach ($this->sliders as $row): 
                                                    $slider = new Sliders();
                                                    $slider = $row;
                                            ?>
                                            <tr>
                                                <td>
                                                    <span class="d-block"><?= $slider->id_image; ?></span>
                                                </td>

                                                <td class="align-middle">
                                                    <span class="status-span badge-secondary text-secondary">
                                                        <?= $slider->image; ?>
                                                    </span>
                                                </td>

                                                <td class="align-middle">
                                                    <?php if ($slider->status == 1) : ?>
                                                        <span class="status-span badge-primary badge-active">
                                                            Activo
                                                        </span>
                                                    <?php elseif ($slider->status == 2) : ?>
                                                        <span class="status-span badge-primary badge-delete">
                                                            Desactivado
                                                        </span>
                                                    <?php endif ?>
                                                </td>

                                                <td class="align-middle">
                                                    <?php if ($slider->status == 1) : ?>
                                                        <a href="<?= constant('URL'); ?>slider/status?id=<?= $slider->id_image; ?>&status=2" class="status-span badge-primary badge-activo">
                                                            <i class="fas fa-arrow-down"></i>
                                                        </a>
                                                    <?php elseif ($slider->status == 2) : ?>
                                                        <a href="<?= constant('URL'); ?>slider/status?id=<?= $slider->id_image; ?>&status=1" class="status-span badge-primary badge-active">
                                                            <i class="fas fa-arrow-up"></i>
                                                        </a>
                                                    <?php endif ?>
                                                </td>

                                                <td class="align-middle">
                                                    <a href="<?= constant('URL'); ?>slider/delete?id=<?= $slider->id_image; ?>" class="status-span badge-primary badge-delete">
                                                        <i class="fas fa-trash-alt"></i>
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

        <section  id="imagen-guardada" class="py-3">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-10 form-color p-4 shadow-sm">
                        <h4 class="pb-1 text-slider font-weight-bold">Imaganes activas</h4>

                        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img class="d-block w-100" src="">
                                </div>
                                <?php 
                                    require_once 'models/admin/sliders.php';
                                    foreach ($this->sliders as $row): 
                                        $slider = new Sliders();
                                        $slider = $row;
                                ?>
                                <?php if ($slider->status == 1): ?>
                                <div class="carousel-item">
                                    <img class="d-block w-100" src="<?= constant('SDR') . $slider->image; ?>">
                                </div>    
                                <?php endif ?>
                                <?php endforeach ?>
                            </div>

                            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>

                            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>