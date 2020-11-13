    <!-- buscador  -->
    <section id="py-6">
        <div class="container">
            <div class="row d-flex align-items-center justify-content-center">
                <form class="form-inline position-relative my-2 d-inline-block w-50">
                    <button class="btn btn-search position-absolute" type="submit"><i class="fas fa-search"></i></button>
                    <input class="form-control mr-sm-2 w-100" type="" placeholder="Buscador" aria-label="Search">
                </form>
            </div>
        </div>
    </section>
    <!-- slider -->
    <section id="slider">
        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block w-100 mx-auto" src="<?= constant('SDR'); ?>promo.jpg" class="img-fluid" alt="First slide" >
                </div>

                <?php 
                    require_once 'models/admin/sliders.php';
                    foreach ($this->sliders as $row): 
                        $slider = new Sliders();
                        $slider = $row;
                ?>
                <?php if ($slider->status == 1): ?>
                <div class="carousel-item">
                    <img class="d-block w-100 mx-auto" src="<?= constant('SDR') . $slider->image; ?>" class="img-fluid">
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
    </section>

    <!-- cantegorias -->
    <section id="categoria-index" class="pt-5">
        <div class="container">
            <div class="card-deck">
                <div class="card">
                    <div class="card-body text-center">
                        <img src="<?= constant('CTG'); ?>television.png" alt="" class="img-fluid">
                        <p class="card-text font-weight-bold">Electronica</p>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body text-center">
                        <img src="<?= constant('CTG'); ?>chaqueta.png" alt="" class="img-fluid">
                        <p class="card-text font-weight-bold">chamarras</p>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body text-center">
                        <img src="<?= constant('CTG'); ?>cocina.png" alt="" class="img-fluid">
                        <p class="card-text font-weight-bold">Articulos de mesa</p>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body text-center">
                        <img src="<?= constant('CTG'); ?>zapatillas.png" alt="" class="img-fluid">
                        <p class="card-text font-weight-bold">Tenis</p>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body text-center">
                        <img src="<?= constant('CTG'); ?>ordenador.png" alt="">
                        <p class="card-text font-weight-bold">Laptos</p>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <script src="<?= constant('JS'); ?>categories.js"></script>
    <section id="categorias">
        <div class="container-fluid">
            <div class="row">
                <div class="col-6 col-md-2 py-3">
                    <nav class="navbar-expand-lg nv-responsive-cat">
                        <a class="navbar-toggler" data-toggle="collapse" data-target="#menucategoria"
                            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                            <i class="fas fa-bars icon-bar"></i><small class="reponsive-categoria">Categorias</small>
                        </a>
                        <div class="collapse navbar-collapse" id="menucategoria">
                            <div class="wrapper">
                                <ul class="list-unstyled components">
                                    <h6 class="title-categoria pl-4 pb-3">Ver categorias</h6>

                                    <?php 
                                        require_once 'models/admin/category.php';
                                        foreach ($this->categories as $row): 
                                            $category = new Category();
                                            $category = $row;
                                    ?>
                                    <li class="listas-desplegable">
                                        <i class="fas fa-angle-down"></i>
                                        <a href="#link<?= $category->id_category; ?>" data-toggle="collapse"
                                            aria-expanded="false" class="pl-2"
                                            onclick="getSubcategories(<?= $category->id_category; ?>)">
                                            <?= $category->category; ?>
                                        </a>
                                        <ul class="collapse list-unstyled" id="link<?= $category->id_category; ?>">

                                        </ul>
                                    </li>
                                    <?php endforeach ?>
                                </ul>
                            </div>
                        </div>
                    </nav>
                </div>

                <div class="col-sm-6 col-md-10 py-3">
                    <div class="d-flex justify-content-end py-3 border-register">
                        <p class="texto-orden">Ordenado por: </p>
                        <a class=" dropdown-toggle ml-2 orden-submenu" data-toggle="dropdown">
                            recomendados
                        </a>
                        <div class="dropdown-menu drop-menu-opt">
                            <a class="dropdown-item drop-option" href="#">Mas popular</a>
                            <a class="dropdown-item drop-option" href="#">Precio bajo</a>
                            <a class="dropdown-item drop-option" href="#">Precio alto</a>
                            <a class="dropdown-item drop-option" href="#">Mas popular</a>
                            <a class="dropdown-item drop-option" href="#">Precio bajo</a>
                            <a class="dropdown-item drop-option" href="#">Precio alto</a>
                            <a class="dropdown-item drop-option" href="#">Mas popular</a>
                            <a class="dropdown-item drop-option" href="#">Precio bajo</a>
                            <a class="dropdown-item drop-option" href="#">Precio alto</a>
                        </div>
                    </div>

                    <div class="cards-produt pt-2">
                        <small class="py-5 resultado">120 resultados</small>
                        <div class="row">
                            <div class="container pt-4">
                                <div class="row">
                                    <div class="col-lg-4 card-responsive border-0">
                                        <div class="card my-3 border-0">
                                            <img src="<?= constant('PRO'); ?>puma.jpg" class="card-img-top img-fluid w-75 mx-auto">
                                            <div class="position-absolute bg-danger p-2 text-light">
                                                <small class="">Oferta 10% de descuento</small>
                                            </div>
                                            <div class="card-body product-info text-dark">
                                                <h6 class="font-weight-bold lead">RS-X Hard Drive High Puma</h6>
                                                <small class="font-weight-bold"><del>Precio original: $4500</del> - Solo por hoy a $3500</small>
                                                <div class="d-block mt-2">
                                                <a href="#" class="btn btn-dark d-block buy-now">Comprar Ahora</a>
                                                </div>                                             
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 card-responsive border-0">
                                        <div class="card my-3 border-0">
                                            <img src="<?= constant('PRO'); ?>video.jpg" class="card-img-top img-fluid w-75 mx-auto">
                                            <div class="card-body product-info text-dark">
                                                <h6 class="font-weight-bold lead">Videoportero inalámbrico</h6>
                                                <small class="font-weight-bold">Precio: $4500</small>
                                                <div class="d-block mt-2">
                                                <a href="#" class="btn btn-dark d-block buy-now">Comprar Ahora</a>
                                                </div>                                             
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 card-responsive border-0">
                                        <div class="card my-3 border-0">
                                            <img src="<?= constant('PRO'); ?>madcatz.jpg" class="card-img-top img-fluid w-75 mx-auto">
                                            <div class="card-body product-info text-dark">
                                                <h6 class="font-weight-bold lead">Mouse Mad Catz láser Gaming</h6>
                                                <small class="font-weight-bold">Precio: $4500</small>
                                                <div class="d-block mt-2">
                                                <a href="#" class="btn btn-dark d-block buy-now">Comprar Ahora</a>
                                                </div>                                             
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>