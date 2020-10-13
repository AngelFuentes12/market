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

    <!-- CSS Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>

    <!-- JS Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</head>

<body>
    
    <div class="d-flex" id="content-wrapper">
        <div id="sidebar-container" class="border-right">
            <div class="logo pr-3">
                <a class="navbar-brand" href="<?= constant('URL'); ?>admin/">
                    <img src="<?= constant('PIC'); ?>logotipo.png" style="width: 110px;">
                </a>
            </div>
            <div class="menu list-group-flush">
                <a href="<?= constant('URL'); ?>admin" class="list-group-item list-group-item-action text-muted">
                    <i class="fas fa-house-user"></i> Inicio
                </a>

                <a href="<?= constant('URL'); ?>admins" class="list-group-item list-group-item-action text-muted"> 
                    <i class="fas fa-user-shield"></i> Administradores
                </a>

                <a href="<?= constant('URL'); ?>users" class="list-group-item list-group-item-action text-muted"> 
                    <i class="fas fa-users"></i> Clientes
                </a>

                <a href="<?= constant('URL'); ?>categories" class="list-group-item list-group-item-action text-muted"> 
                    <i class="fas fa-chevron-circle-down"></i> Categorías
                </a>

                <a href="<?= constant('URL'); ?>vendors" class="list-group-item list-group-item-action text-muted"> 
                    <i class="fas fa-user-tie"></i> Proveedores
                </a>

                <a href="<?= constant('URL'); ?>products" class="list-group-item list-group-item-action text-muted"> 
                    <i class="fab fa-shopify"></i> Productos
                </a>

                <a href="<?= constant('URL'); ?>buys" class="list-group-item list-group-item-action text-muted"> 
                    <i class="fas fa-shopping-cart"></i> Compras
                </a>

                <a href="<?= constant('URL'); ?>slider" class="list-group-item list-group-item-action text-muted"> 
                    <i class="fas fa-images"></i> Slider
                </a>

                <a href="<?= constant('URL'); ?>admin/logout" class="list-group-item list-group-item-action text-muted"> 
                    <i class="fas fa-arrow-down"></i> Salir
                </a>
            </div>
        </div>

        <div id="page-content-wrapper" class="w-100 bg-light-blue">

            <nav class="navbar navbar-expand-lg border-bottom nav-color">
                <div class="container">
                    <button class="btn btn-outline-dark" id="menu-toggle">
                        <i class="fas fa-bars"></i>
                    </button>

                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"><i class="fas fa-bars"></i></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                            <li class="nav-item">
                                <a class="nav-link submenu" href="<?= constant('URL'); ?>messages">
                                    <i class="fas fa-envelope-open-text"></i> Mensajeria
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link submenu" href="#">
                                    <i class="fas fa-bell"></i> Notificaciones
                                </a>
                            </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle user-title" href="#" id="dropdownProducts" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-user fa-fw"></i> <?= $_SESSION['email']; ?>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="dropdownProducts">
                                    <a class="nav-link submenu" href="#">
                                        <i class="fa fa-user fa-fw"></i>Perfil
                                    </a>
                                    <a class="nav-link submenu" href="#">
                                        <i class="fa fa-gear fa-fw"></i>Configuración
                                    </a>
                                    <a class="nav-link submenu" href="<?= constant('URL'); ?>admin/logout">
                                        <i class="fa fa-sign-out fa-fw"></i>Desconectarte
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <script>
                $("#menu-toggle").click(function(e) {
                    e.preventDefault();
                    $("#content-wrapper").toggleClass("toggled");
                });
            </script>

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


            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

            <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>