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
	
	<!-- CSS Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>

    <!-- JS Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</head>
<body>
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="<?= constant('URL'); ?>">
                <img src="<?= constant('PIC'); ?>logotipo.png" style="width: 180px;">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    
                </ul>

                <ul class="navbar-nav ml-auto">

                <?php if (isset($_SESSION['user'])): ?>

                    <li class="nav-item">
                        <a class="nav-link" href="<?= constant('URL'); ?>user/index">
                            Perfil
                        </a>
                    </li>
                
                    <li class="nav-item">
                        <a class="nav-link" href="<?= constant('URL'); ?>user/logout">
                            Cerrar Sesión
                        </a>
                    </li>

                <?php else: ?>

                    <li class="nav-item">
                        <a class="nav-link" href="<?= constant('URL'); ?>auth/index">
                            Iniciar Sesión
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="<?= constant('URL'); ?>auth/register">
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