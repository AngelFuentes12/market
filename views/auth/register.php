<section id="login">
    <div class="container">
        <div class="row justify-content-center p-3 pb-5">
            <div class="col-12 col-md-8 form-color p-5">
                <div class="informacion-registro">
                    <h3>¿Aún no es miembro?</h3>
                    <!-- <div class="d-flex justify-content-end pb-3 border-register">
                        <p class="font-weight-bold">Campos obligatorios <span style="color: red;">*</span></p>
                    </div> -->
                    <p>Recuerda que debes de ingresar datos validos y activos.</p>
                </div>
                <form action=".php" method="POST" class="js-validation" novalidate>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="inputEmail4">Email</label>
                            <input type="email" class="form-control" id="inputEmail4" placeholder="Email" required>
                            <!-- validation -->
                            <div class="valid-feedback">Excelente</div>
                            <div class="invalid-feedback">Tu correo debe ser activo, Por favor ingrese correo valido</div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPassword4">Password</label>
                            <input type="password" class="form-control" id="inputPassword4" placeholder="Password">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPassword4">Password</label>
                            <input type="password" class="form-control" id="inputPassword4" placeholder="Password">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputAddress">Address</label>
                        <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
                    </div>
                    <div class="form-group">
                        <label for="inputAddress2">Address 2</label>
                        <input type="text" class="form-control" id="inputAddress2"
                            placeholder="Apartment, studio, or floor">
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputCity">City</label>
                            <input type="text" class="form-control" id="inputCity">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="inputState">State</label>
                            <select id="inputState" class="form-control">
                                <option selected>Choose...</option>
                                <option>...</option>
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="inputZip">Zip</label>
                            <input type="text" class="form-control" id="inputZip">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="gridCheck">
                            <label class="form-check-label" for="gridCheck">
                                Check me out
                            </label>
                        </div>
                    </div>
                    <input type="submit" class="btn btn-login" value="Sign in">
                </form>
            </div>
        </div>
    </div>
</section>

<script src="<?= constant('JS') ?>validations.js"></script>