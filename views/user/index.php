<section id="index-cliente">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="py-5">
                    <h3 class="font-weight-bold">Bienvenido @<?= $_SESSION['name'];?></h3>
                    <small class="text-muted font-weight-bold pb-3">Correo: <?= $_SESSION['email'];?></small>
                    <a href="#" class="text-info font-weigth-bold d-block pt-2"><small>Editar Perfil</small></a>
                </div>

                <div class="row">
                    <div class="col-lg-4">
                        <small class="font-weight-bold">Numero de compras</small>
                        <h3 class="py-3 font-weight-bold">13</h3>
                    </div>
                    <div class="col-lg-4">
                        <small class="font-weight-bold">Lista de deseos</small>
                        <h3 class="py-3 font-weight-bold">43</h3>
                    </div>

                    <div class="col-lg-12 mt-3">
                        <small class="lead font-weight-bold py-4">Servicio al Cliente</small>
                    </div>

                    <div class="col-lg-4 my-5">
                        <p>Correo</p>
                        <p><img src="<?= constant('PIC');?>correo.png" alt="" class="img-fluid"></p>
                        <small class="text-muted">shopweb@gmail.com</small>
                    </div>
                    <div class="col-lg-4 my-5">
                        <p>Telefono</p>
                        <p><img src="<?= constant('PIC');?>telefono.png" alt="" class="img-fluid"></p>
                        <small class="text-muted">55 4543 2345</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="py-5 d-flex">
					<img src="<?= constant('USR');?>alberto.jpg" class="img-fluid w-25 mx-auto rounded-circle">
                </div>

                <div class="row">
                    <div class="col-lg-3">
                        <p class="font-weight-bold">Mis cupones</p>
                        <h5 class="text-center">0</h5>
                    </div>
                    <div class="col-lg-3">
                        <p class="font-weight-bold">Tus Puntos</p>
                        <h5 class="text-center">0</h5>
                    </div>
                    <div class="col-lg-3">
                        <p class="font-weight-bold">Tarjeta regalo</p>
                        <h5 class="text-center">2</h5>
                    </div>
                </div>
                <p class="font-weight-bold mt-5 text-muted">Tus pedidos</p>
                <div class="row">
                    <div class="col-lg-3">
                        <p class="font-weight-bold">No pagado</p>
                        <p class="text-center"><img src="<?= constant('PIC');?>pago.png" alt="" class="img-fluid"></p>
                    </div>
                    <div class="col-lg-3">
                        <p class="font-weight-bold">Enviados</p>
                        <p class="text-center"><img src="<?= constant('PIC');?>entrega.png" alt="" class="img-fluid">
                        </p>
                    </div>
                    <div class="col-lg-3">
                        <p class="font-weight-bold">Devoluación</p>
                        <p class="text-center"><img src="<?= constant('PIC');?>comprar.png" alt="" class="img-fluid">
                        </p>
                    </div>

                    <div class="col-lg-12 my-5 bg-pedido">
                        <h6 class="text-center my-5">Actualmente no tienes pedidos</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>