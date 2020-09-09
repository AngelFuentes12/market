<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title><?php echo constant('NAME'); ?> | <?php echo $this->url; ?></title>

	<!-- Icon -->
	<link rel="icon" href="<?php echo constant('PIC');?>/icon.png">

	<!-- FontAwesome -->
	<script src="https://kit.fontawesome.com/39610b5df0.js" crossorigin="anonymous"></script>

    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="<?php echo constant('CSS'); ?>style.css">
	
	<!-- CSS Bootstrap -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

	<!-- JS Bootstrap -->
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</head>
<body>
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="<?php echo constant('URL'); ?>">
                <img src="<?php echo constant('PIC'); ?>logotipo.png" style="width: 180px;">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    Header admin
                </ul>

                <ul class="navbar-nav ml-auto">

                <?php if (isset($_SESSION['admin'])): ?>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdownProducts" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Productos
                        </a>
                        <div class="dropdown-menu" aria-labelledby="dropdownProducts">
                            <a class="nav-link" href="<?php echo constant('URL'); ?>product/show">
                                Ver productos
                            </a>
                            <a class="nav-link" href="<?php echo constant('URL'); ?>product/index">
                                Agregar productos
                            </a>
                        </div>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdownProducts" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Marcas
                        </a>
                        <div class="dropdown-menu" aria-labelledby="dropdownProducts">
                            <a class="nav-link" href="<?php echo constant('URL'); ?>mark/show">
                                Ver marcas
                            </a>
                            <a class="nav-link" href="<?php echo constant('URL'); ?>mark/index">
                                Agregar marca
                            </a>
                        </div>
                    </li>
                
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo constant('URL'); ?>admin/logout">
                            Cerrar Sesión
                        </a>
                    </li>

                <?php else: ?>

                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo constant('URL'); ?>auth/index">
                            Iniciar Sesión
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo constant('URL'); ?>auth/register">
                            Registrarse
                        </a>
                    </li>
                
                <?php endif ?>

                </ul>
            </div>
        </div>
    </nav>

    <?php if ($this->error['alert'] != ''): ?>
    <div class="container">
        <div class="row">
            <div class="col-md-8 text-center mx-auto">
                <div class="alert <?php echo $this->error['alert']; ?> alert-dismissible fade show m-3" role="alert">
                    <?php echo $this->error['message']; ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <?php endif ?>