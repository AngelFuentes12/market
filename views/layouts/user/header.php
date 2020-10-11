<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title><?= constant('NAME'); ?> | <?= $this->title; ?></title>

	<!-- Icon -->
	<link rel="icon" href="<?= constant('PIC');?>/icon.png">

	<!-- FontAwesome -->
	<script src="https://kit.fontawesome.com/39610b5df0.js" crossorigin="anonymous"></script>

    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="<?= constant('CSS'); ?>style.css">

    <!-- fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500&display=swap" rel="stylesheet">
	
	<!-- CSS Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>

    <!-- JS Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</head>
<body>
<!-- descuentos -->

<nav id="nav-descuento" class="navbar">
  <span class="text-nav">Envíos GRATIS en compras mayores a $599.00 pesos</span>
</nav>

    <nav class="navbar navbar-expand-md shadow-sm">
            <a class="navbar-brand pl-3" href="<?= constant('URL'); ?>">
                <img src="<?= constant('PIC'); ?>logotipo.png" style="width: 125px;">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"><i class="fas fa-bars"></i></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <div class="mx-auto">

                <ul class="nav justify-content-center">

                <?php if (isset($_SESSION['user'])): ?>

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

                <?php else: ?>

                    <li class="nav-item">
                        <a class="nav-link submenu" href="">HOME</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link submenu" href="">NOSOTROS</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link submenu" href="">PRODUCTOS</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link submenu" href="">CONTACTOS</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link submenu" href="">CONTACTOS</a>
                    </li>
                </ul>
            </div>
            </div>

            <div class="mx-auto m-0 p-0" id="">
                <ul class="nav justify-content-end">
                <li class="nav-item">
                        <a class="nav-link submenu" href="#"><i class="fas fa-shopping-bag"></i> (0)</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link submenu" href="#"><i class="fas fa-heart"></i></a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link submenu" href="<?= constant('URL'); ?>auth/index"><i class="far fa-user"></i></a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link submenu registrate" href="<?= constant('URL'); ?>auth/register">REGISTRATE</a>
                    </li>

                <?php endif ?>
                </ul>
            </div>
    </nav>

    <?php if ($this->error['alert'] != ''): ?>
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