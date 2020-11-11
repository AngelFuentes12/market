<section id="login">
    <div class="container">
        <div class="row justify-content-center p-3 pb-5">
            <div class="col-12 col-md-8 form-color p-5 shadow-sm">
                <div class="informacion-registro">
                    <div class="text-center">
                        <h3 class="register-cliente-title">¿Aún no es miembro?</h3>
                    </div>
                    <div class="d-flex justify-content-end pb-3 border-register">
                        <p class="font-weight-bold campos-obligatorios">Campos obligatorios <span
                                style="color: red;">*</span></p>
                    </div>
                    <p class="recordatorio">Recuerda que debes de ingresar datos validos y activos.</p>
                </div>
                <form action=".php" method="POST" class="js-validation" novalidate>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="inputEmail4">Correo Electronico <span style="color: red;">*</span></label>

                            <span class="hint--top hint--rounded hint--info hint--medium" style="cursor: pointer;"
                                aria-label="Si tienes 2 correos electronicos, ingresa ambos colocando una coma por ejemplo:
                                 correo@correo.com,
                                 correo@correo.com">
                                <i class="fas fa-info-circle"></i>
                            </span>

                            <input type="email" class="form-control" id="inputEmail4" required>
                            <!-- validation -->
                            <div class="valid-feedback">Excelente</div>
                            <div class="invalid-feedback">Tu correo debe ser activo, Por favor ingrese correo valido
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPassword4">Contraseña <span style="color: red;">*</span></label>
                            <input type="password" class="form-control" id="inputPassword4" required>
                            <!-- validación -->
                            <div class="invalid-feedback">
                                Ingresa una contraseña
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPassword4">Verificación Contraseña <span
                                    style="color: red;">*</span></label>
                            <input type="password" class="form-control" id="inputPassword4" required>
                            <!-- validación -->
                            <div class="invalid-feedback">
                                Verifica tu contraseña
                            </div>
                        </div>
                    </div>
                    <p>Datos personales</p>
                    <div class="form-row">
                        <div class="form-group col-md-8">
                            <label for="nameclient">Nombre(s) <span style="color: red;">*</span> </label>
                            <input type="text" class="form-control" id="nameclient" required>
                            <!-- validación -->
                            <div class="invalid-feedback">
                                Ingresa tu Nombre
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="inputrfc">RFC <span style="color: red;">*</span> </label>
                            <input type="text" class="form-control" id="inputrfc" required>
                            <!-- validación -->
                            <div class="invalid-feedback">
                                Ingresa tu RFC
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="phoneclient">Teléfono <span style="color: red;">*</span></label>
                            <span class="hint--top hint--rounded hint--info hint--medium" style="cursor: pointer;"
                                aria-label="Si tienes 2 Telefonos Ingresa ambos colcando una coma por ejemplo: 
                                554 6754 123,
                                554 6754 123 ">
                                <i class="fas fa-info-circle"></i>
                            </span>
                            <input type="text" class="form-control" id="phoneclient" required>
                            <!-- validación -->
                            <div class="invalid-feedback">
                                Ingresa un numero de teléfono
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="inputState">Estado <span style="color: red;">*</span></label>
                            <select id="inputState" class="form-control" required>
                                <option selected>Selecciona</option>
                                <option>Example</option>
                            </select>
                            <!-- validación -->
                            <div class="invalid-feedback">
                                Selecciona un Estado
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="inputmunicipio">Municipio <span style="color: red;">*</span> </label>
                            <select id="inputmunicipio" class="form-control" required>
                                <option selected>Selecciona</option>
                                <option>Example</option>
                            </select>
                            <!-- validación -->
                            <div class="invalid-feedback">
                                Selecciona un Municipio
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="inputcolonia">Colonia <span style="color: red;">*</span></label>
                            <select id="inputcolonia" class="form-control" required>
                                <option selected>Selecciona</option>
                                <option>Example</option>
                            </select>
                            <!-- validación -->
                            <div class="invalid-feedback">
                                Selecciona una Colonia
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="inputpost">Codigo Postal <span style="color: red;">*</span></label>
                            <select id="inputpost" class="form-control" required>
                                <option selected>Selecciona</option>
                                <option>Example</option>
                            </select>
                            <!-- validación -->
                            <div class="invalid-feedback">
                                Selecciona un Codigo Postal
                            </div>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="numberint">N0. Interior <span style="color: red;">*</span></label>
                            <input type="text" class="form-control" id="numberint" required>
                            <!-- validación -->
                            <div class="invalid-feedback">
                                Ingresa un Numero Interior
                            </div>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="numberext">N0. Exterior <span style="color: red;">*</span></label>
                            <input type="text" class="form-control" id="numberext" required>
                            <!-- validación -->
                            <div class="invalid-feedback">
                                Ingresa un Numero Exterior
                            </div>
                        </div>

                        <div class="form-group col-md-12">
                            <label for="callecliente">Calle <span style="color: red;">*</span></label>
                            <input type="text" class="form-control" id="callecliente" required>
                            <!-- validación -->
                            <div class="invalid-feedback">
                                Ingresa una Calle
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="gridCheck" data-toggle="modal"
                                data-target="#exampleModalLong" required>
                            <label class="form-check-label" for="gridCheck">
                                <small>Acepto terminos y condiciones</small>
                            </label>
                            <!-- validación -->
                            <div class="invalid-feedback">
                                Tienes que Aceptar los Terminos y Condiciones
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center align-items-center">
                        <input type="submit" class="btn btn-login" value="Registrarme">
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- modal terminos -->

<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Terminos y Condiciones</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Choro de terminos y condiciones</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<script src="<?= constant('JS') ?>validations.js"></script>