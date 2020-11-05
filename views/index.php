    <!-- buscador  -->
    <!-- <div class="container">
        <form action="" method="post" class="">
            <div class="md-form active-cyan-2 mb-4 mt-4">
                <input class="form-control" type="text" placeholder="Buscador" aria-label="Search">
            </div>
        </form>
    </div> -->

    <!-- slider -->
    <section id="slider">
        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block w-100 mx-auto" src="<?= constant('SDR'); ?>promo.jpg" alt="First slide">
                </div>

                <?php 
                    require_once 'models/admin/sliders.php';
                    foreach ($this->sliders as $row): 
                        $slider = new Sliders();
                        $slider = $row;
                ?>
                <?php if ($slider->status == 1): ?>
                <div class="carousel-item">
                    <img class="d-block w-100 mx-auto" src="<?= constant('SDR') . $slider->image; ?>">
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
                        <img src="<?= constant('CTG'); ?>television.png" alt="">
                        <p class="card-text">Electronica</p>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body text-center">
                        <img src="<?= constant('CTG'); ?>chaqueta.png" alt="">
                        <p class="card-text">chamarras</p>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body text-center">
                        <img src="<?= constant('CTG'); ?>cocina.png" alt="">
                        <p class="card-text">Articulos de mesa</p>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body text-center">
                        <img src="<?= constant('CTG'); ?>zapatillas.png" alt="">
                        <p class="card-text">Tenis</p>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body text-center">
                        <img src="<?= constant('CTG'); ?>ordenador.png" alt="">
                        <p class="card-text">Laptos</p>
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
                            <i class="fas fa-bars icon-bar"></i><small class="reponsive-categoria">Ver categorias</small>
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
                                        <i class="far fa-circle"></i>
                                        <a href="#link<?= $category->id_category; ?>" data-toggle="collapse" aria-expanded="false"
                                            class="pl-2" onclick="getSubcategories(<?= $category->id_category; ?>)">
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
                                <div class="col-lg-4 card-responsive">
                                    <div class="card">
                                        <img src="" class="card-img-top" alt="">
                                        <small>Foto del pruducto</small>
                                        <!-- nota elimina el small cuando leas esto pendejo xd-->
                                        <div class="card-body info-products-card">
                                            <h5 class="card-title">Nombre del producto</h5>
                                            <p class="card-text">Información del producto.</p>
                                            <center><a href="#" class="btn-login p-2 btn-comprar">Comprar Ahora</a>
                                            </center>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 card-responsive">
                                    <div class="card">
                                        <img src="" class="card-img-top" alt="">
                                        <div class="card-body info-products-card">
                                            <h5 class="card-title">Card title</h5>
                                            <p class="card-text">Some quick example text to build on the card title and
                                                make
                                                up the bulk of the card's content.</p>
                                            <a href="#" class="btn btn-primary">Go somewhere</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 card-responsive">
                                    <div class="card">
                                        <img src="" class="card-img-top" alt="">
                                        <div class="card-body info-products-card">
                                            <h5 class="card-title">Card title</h5>
                                            <p class="card-text">Some quick example text to build on the card title and
                                                make
                                                up the bulk of the card's content.</p>
                                            <a href="#" class="btn btn-primary">Go somewhere</a>
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