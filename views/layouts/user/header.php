<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?= constant('NAME'); ?> | <?= $this->title; ?></title>

    <!-- Icon -->
    <link rel="icon" href="<?= constant('PIC'); ?>/icon.png">

    <!-- FontAwesome -->
    <script src="https://kit.fontawesome.com/39610b5df0.js" crossorigin="anonymous"></script>

    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="<?= constant('CSS'); ?>style.css">
    <link rel="stylesheet" type="text/css" href="<?= constant('CSS'); ?>hint.min.css">

    <!-- fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@500;700;800&display=swap" rel="stylesheet">

    <!-- CSS Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>

    <!-- JS Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
</head>

<body>
    <!-- descuentos -->
    <nav id="nav-descuento" class="navbar">
        <span class="text-nav">Envíos GRATIS en compras mayores a $599.00 pesos</span>
    </nav>
<!--  -->
    <nav class="nav nav-oculto">
        <ul class="nav ml-auto pr-5 nav-information">
            <li class="nav-item ">
                <a class="nav-link" href="#">Politicas</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Atención a clientes</a>
            </li>
            <li class="nav-item">
                <a class="nav-link">Correo: ShopMarket@market.com</a>
            </li>
            <li class="nav-item">
                <a class="nav-link">Tel: 4534 5546 23</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#"> <img src="<?= constant('CSS'); ?>mexico.png"> MX</a>
            </li>
        </ul>
    </nav>

<!--  -->
    <nav class="navbar navbar-expand-md ">
        <a class="navbar-brand pl-3" href="<?= constant('URL'); ?>">
            <img src="<?= constant('PIC'); ?>logotipo.png" style="width: 125px;">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"><i class="fas fa-bars"></i></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <div class="mx-auto">

                <ul class="nav justify-content-center">

                    <?php if (isset($_SESSION['user'])) : ?>

                        <li class="nav-item">
                            <a class="nav-link submenu" href="#">
                                Modo de Entrega
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link submenu" href="#">
                                Tus compras
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link submenu" href="#">
                                Promociones
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link submenu" href="#">
                                Recibos
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link submenu" href="#"><i class="fas fa-shopping-bag"></i> (0)</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link submenu" href="#"><i class="fas fa-heart"></i> Lista de deseos</a>
                        </li>

                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link submenu" href="#">
                                    <i class="far fa-smile-wink"></i> Hola, <?= $_SESSION['email']; ?>
                                </a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="dropdownProducts" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-gear fa-fw"></i>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="dropdownProducts">
                                    <a class="nav-link submenu" href="<?= constant('URL'); ?>user/index">
                                        <i class="fa fa-user fa-fw fa-fa-user"></i>Perfil
                                    </a>
                                    <a class="nav-link submenu" href="#">
                                        <i class="fa fa-gear fa-fw"></i>Configuración
                                    </a>
                                    <a class="nav-link submenu" href="<?= constant('URL'); ?>user/logout">
                                        <i class="fa fa-sign-out fa-fw"></i>Desconectarte
                                    </a>
                                </div>
                            </li>
                        </ul>

                    <?php else : ?>

                        <li class="nav-item">
                            <a class="nav-link submenu" href="<?= constant('URL'); ?>">INICIO</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link submenu" href="#">NOSOTROS</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link submenu" href="#">PRODUCTOS</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link submenu" href="#">CATEGORIAS</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link submenu" href="<?= constant('URL'); ?>contact">CONTACTO</a>
                        </li>
                </ul>
            </div>
        </div>

        <div class="mx-auto m-0 p-0" id="">
            <ul class="nav justify-content-end">
                <li class="nav-item">
                    <a class="nav-link submenu hint--bottom hint--rounded" aria-label="Compras" href="#"><i class="fas fa-shopping-bag"></i> (0)</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link submenu hint--bottom hint--rounded" aria-label="Lista de deseos" href="#"><i class="fas fa-heart"></i> (0)</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link submenu hint--bottom hint--rounded" aria-label="Iniciar Sesión" href="<?= constant('URL'); ?>auth/index"><i class="far fa-user"></i></a>
                </li>

                <li class="nav-item">
                    <a class="nav-link submenu registrate" href="<?= constant('URL'); ?>auth/register">REGISTRATE</a>
                </li>

            <?php endif ?>
            </ul>
        </div>
    </nav>

    <?php if ($this->error['alert'] != '') : ?>
        <div class="container">
            <div class="row">
                <div class="col-md-8 text-center mx-auto">
                    <div class="alert <?= $this->error['alert']; ?> alert-dismissible fade show m-3" role="alert">
                        <?= $this->error['message']; ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    <?php endif ?>