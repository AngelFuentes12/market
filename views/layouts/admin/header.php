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

    <!-- CSS Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <!-- DataTable CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.css">

    <!--animate.css  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>

    <!-- chart.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <!-- JS Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
</head>

<body>

    <div class="d-flex" id="content-wrapper">
        <div id="sidebar-container" class="border-right">
            <div class="logo pr-3">
                <a class="navbar-brand" href="<?= constant('URL'); ?>admin/">
                    <img src="<?= constant('PIC'); ?>logotipo.png" style="width: 100px;">
                </a>
            </div>
            <div class="menu list-group-flush">
                <a href="<?= constant('URL'); ?>admin" class="list-group-item list-group-item-action">
                    <i class="fas fa-house-user"></i>
                    <small class="pl-4 text-muted">Dashboard</small>
                </a>

                <div class="dropdown">
                    <!-- <button class="list-group-item list-group-item-action dropdown-toggle" type="button" id="direcciones" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-road"></i>
                        <small class="pl-4 text-muted">Direcciones</small>

                        *SI LA INFO ESTA BIEN DE CLASSES Y ID Y DEMAS BORRA ESTO
                    </button> -->
                    <a class="list-group-item list-group-item-action text-muted" href="#" id="dropdownProducts" id="direcciones" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-road"></i>
                        <small class="pl-4 text-muted">Direcciones</small>
                        <small class="pl-5"><i class="fas fa-caret-down"></i></small>

                    </a>

                    <div class="dropdown-menu" aria-labelledby="direcciones">
                        <a class="nav-link submenu" href="<?= constant('URL'); ?>states">Estados</a>
                        <a class="nav-link submenu" href="<?= constant('URL'); ?>municipalities">Municipios</a>
                        <a class="nav-link submenu" href="<?= constant('URL'); ?>colonies">Colonias</a>
                        <a class="nav-link submenu" href="<?= constant('URL'); ?>postcodes">Codigos Postales</a>
                    </div>
                </div>

                <a href="<?= constant('URL'); ?>admins" class="list-group-item list-group-item-action">
                    <i class="fas fa-user-shield"></i><small class="pl-4 text-muted">Administradores</small>
                </a>

                <a href="<?= constant('URL'); ?>users" class="list-group-item list-group-item-action">
                    <i class="fas fa-users"></i>
                    <small class="pl-4 text-muted">Clientes</small>
                </a>

                <a href="<?= constant('URL'); ?>secretaries" class="list-group-item list-group-item-action text-muted">
                    <i class="fas fa-user-shield"></i>
                    <small class="pl-4 text-muted">Secretarias</small>
                </a>

                <a href="<?= constant('URL'); ?>categories" class="list-group-item list-group-item-action">
                    <i class="fas fa-chevron-circle-down"></i>
                    <small class="pl-4 text-muted">Categorías</small>
                </a>

                <a href="<?= constant('URL'); ?>subcategories" class="list-group-item list-group-item-action">
                    <i class="fas fa-chevron-circle-down"></i>
                    <small class="pl-4 text-muted">Subcategorías</small>
                </a>

                <a href="<?= constant('URL'); ?>vendors" class="list-group-item list-group-item-action">
                    <i class="fas fa-user-tie"></i>
                    <small class="pl-4 text-muted">Proveedores</small>
                </a>

                <a href="<?= constant('URL'); ?>products" class="list-group-item list-group-item-action">
                    <i class="fab fa-shopify"></i>
                    <small class="pl-4 text-muted">Productos</small>
                </a>

                <a href="<?= constant('URL'); ?>buys" class="list-group-item list-group-item-action">
                    <i class="fas fa-shopping-cart"></i>
                    <small class="pl-4 text-muted">Compras</small>
                </a>

                <a href="<?= constant('URL'); ?>slider" class="list-group-item list-group-item-action">
                    <i class="fas fa-images"></i>
                    <small class="pl-4 text-muted">Slider</small>
                </a>

                <a href="<?= constant('URL'); ?>admin/logout" class="list-group-item list-group-item-action">
                    <i class="fas fa-arrow-down"></i>
                    <small class="pl-4 text-muted">Salir</small>
                </a>
            </div>
        </div>

        <div id="page-content-wrapper" class="w-100 bg-light-blue">

            <nav class="navbar navbar-expand-lg border-bottom nav-color">
                <div class="container">
                    <button class="btn btn-outline-dark" id="menu-toggle">
                        <i class="fas fa-bars"></i>
                    </button>

                    <button class="navbar-toggler btn-responsive" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"><i class="fas fa-bars"></i></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                            <li class="nav-item dropdown pr-2">
                                <a class="nav-link  user-title" href="#" id="dropdownProducts" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <!-- class="nav-link dropdown-toggle user-title"  -->
                                    <i class="far fa-envelope"></i>
                                </a>
                                <div class="dropdown-menu p-2 div-mensajes animate__animated animate__tada" aria-labelledby="dropdownProducts">
                                    <p class="title-mensajes-notify text-muted">Tienes 1 Mensajes</p>
                                    <a class="nav-link submenu font-weight-bold" href="#">
                                        <small class="punto" style="color: red;"><i class="fas fa-circle"></i></small>
                                        Michalle Rodriguez
                                        <small class="text-muted ml-auto pl-3">Hace 2 horas</small>
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <center><a class="nav-link submenu" href="<?= constant('URL'); ?>messages">Ver Más</a>
                                        <center>
                                </div>
                            </li>

                            <li class="nav-item dropdown pr-2">
                                <a class="nav-link user-title" href="#" id="dropdownProducts" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="far fa-bell"></i>
                                </a>
                                <div class="dropdown-menu p-2 div-mensajes animate__animated animate__tada" aria-labelledby="dropdownProducts">
                                    <p class="title-mensajes-notify text-muted">Tienes 1 Notificación</p>
                                    <a class="nav-link submenu font-weight-bold" href="#">
                                        <small class="punto" style="color: red;"><i class="fas fa-circle"></i></small>
                                        Michalle Rodriguez
                                        <small class="text-muted ml-auto pl-3">Hace 2 horas</small>
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <center><a class="nav-link submenu" href="">Ver Más</a>
                                        <center>
                                </div>
                            </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle user-title" href="#" id="dropdownProducts" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-user fa-fw"></i> <?= $_SESSION['name']; ?>
                                </a>
                                <div class="dropdown-menu div-perfil p-1 animate__animated animate__bounceInDown" aria-labelledby="dropdownProducts">
                                    <p class="pt-2 name-user"><?= $_SESSION['name']; ?></p>
                                    <div class="dropdown-divider"></div>
                                    <a class="nav-link submenu" href="#">
                                        <i class="fa fa-user fa-fw"></i> <small class="pl-2 text-muted">Perfil</small>
                                    </a>
                                    <a class="nav-link submenu" href="#">
                                        <i class="fa fa-gear fa-fw"></i> <small class="pl-2 text-muted">Configuración</small>
                                    </a>
                                    <a class="nav-link submenu" href="<?= constant('URL'); ?>admin/logout">
                                        <i class="fa fa-sign-out fa-fw"></i> <small class="pl-2 text-muted">Cerrar</small>
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
                    $(".btn-responsive").hide();
                    if ($('#content-wrapper').hasClass('toggled')) {
                        $("#content").css("display", "none");
                        $(".btn-responsive").css("display", "none");
                    } else {
                        $("#content").show();
                        $(".btn-responsive").show();
                    }
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