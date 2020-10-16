<div id="content" class="container-fluid p-5">
    <section class="py-3">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-12 form-color p-4 shadow-sm">
                    <h4 class="pb-1">Pagína de proveedores</h4>
                    <div class="row mb-3">
                        <div class="col-xl-12 col-lg-12">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col"><small class="font-weight-bold">Proveedor<small></th>
                                            <th scope="col"><small class="font-weight-bold">Estatus<small></th>
                                            <th scope="col"><small class="font-weight-bold">#<small></th>
                                            <th scope="col"><small class="font-weight-bold">Telefono<small></th>
                                            <th scope="col"><small class="font-weight-bold">Eliminar<small></th>
                                            <th scope="col"><small class="font-weight-bold">Configuración<small></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="">
                                            <td><span class="d-block">Danile H.</span><small class="text-muted">daniela@motorola.com</small></td>
                                            <td class="align-middle"><span class="status-span badge-primary badge-active">Activo</span></td>
                                            <td class="align-middle"><a href="#" class="status-span badge-primary badge-activo"><i class="fas fa-arrow-down"></i></a></td>
                                            <td class="align-middle"><a href="#" class="status-span badge-secondary text-secondary">5545343673</a></td>
                                            <td class="align-middle"><a href="#" class="status-span badge-primary badge-delete"><i class="fas fa-trash-alt"></i></a></td>
                                            <td class="align-middle"><a href="#" class="status-span badge-secondary">Editar <i class="fas fa-cog"></i></a></td>
                                        </tr>
                                        <tr class="">
                                            <td><span class="d-block">Andrea S.</span><small class="text-muted">andrea@samsung.com</small></td>
                                            <td class="align-middle"><span class="status-span badge-primary badge-delete">desactivado</span></td>
                                            <td class="align-middle"><a href="#" class="status-span badge-primary badge-active"><i class="fas fa-arrow-up"></i></a></td>
                                            <td class="align-middle"><a href="#" class="status-span badge-secondary text-secondary">5545343673</a></td>
                                            <td class="align-middle"><a href="#" class="status-span badge-primary badge-delete"><i class="fas fa-trash-alt"></i></a></td>
                                            <td class="align-middle"><a href="#" class="status-span badge-secondary">Editar <i class="fas fa-cog"></i></a></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <a href="#" class="status-span badge-primary text-primary" data-toggle="modal" data-target="#exampleModalCenter">Nuevo <i class="fas fa-user-plus"></i></a>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Modal registro admin-->
<div class="modal animate__animated animate__bounceInRight" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title title-register" id="exampleModalLongTitle">Alberto, registra un nuevo proveedor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="color: red;">&times;</span>
                </button>
            </div>
            <!--  -->
            <div class="modal-body mx-auto">
                <p class="">Los campos marcados con un <small style="color: red;">*</small> son obligatorios</p>
                <form method="POST" action="">
                    <div class="form-group">
                        <label for="name" class="name">Nombre <span style="color: red;">*</span></label>
                        <input type="text" value="" name="name" class="form-control" required>
                        <div class="invalid-feedback">

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email" class="email">Correo Electronico <span style="color: red;">*</span></label>
                        <input type="email" value="" name="email" class="form-control" required>
                        <div class="invalid-feedback">

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="telefono" class="telefono">Telefono <span style="color: red;">*</span></label>
                        <input type="text" value="" name="telefono" class="form-control" required>
                        <div class="invalid-feedback">

                        </div>
                    </div>

                    <div class="form-group">
                        <label for="estado" class="estado">Estado <span style="color: red;">*</span></label>
                        <select class="form-control" id="exampleFormControlSelect1">
                            <option>Seleccionar</option>
                        </select>
                        <div class="invalid-feedback">

                        </div>
                    </div>

                    <div class="form-group">
                        <label for="municipio" class="municipio">Municipio <span style="color: red;">*</span></label>
                        <select class="form-control" id="exampleFormControlSelect1">
                            <option>Seleccionar</option>
                        </select>
                        <div class="invalid-feedback">

                        </div>
                    </div>

                    <div class="form-group">
                        <label for="colonia" class="colonia">Colonia <span style="color: red;">*</span></label>
                        <select class="form-control" id="exampleFormControlSelect1">
                            <option>Seleccionar</option>
                        </select>
                        <div class="invalid-feedback">

                        </div>
                    </div>

                    <div class="form-group">
                        <label for="codigo" class="codigo">Codigo postal <span style="color: red;">*</span></label>
                        <select class="form-control" id="exampleFormControlSelect1">
                            <option>Seleccionar</option>
                        </select>
                        <div class="invalid-feedback">

                        </div>
                    </div>

                    <div class="form-group">
                        <label for="calle" class="calle">Calle <span style="color: red;">*</span></label>
                        <input type="text" value="" name="calle" class="form-control" required>
                        <div class="invalid-feedback">

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="interior" class="interior">Número Interior <span style="color: red;">*</span></label>
                        <input type="text" value="" name="interior" class="form-control" required>
                        <div class="invalid-feedback">

                        </div>
                    </div>

                    <div class="form-group">
                        <label for="exterior" class="exterior">Número Exterior <span style="color: red;">*</span></label>
                        <input type="text" value="" name="exterior" class="form-control" required>
                        <div class="invalid-feedback">

                        </div>
                    </div>

                </form>
            </div>
            <div class="mx-auto pb-5">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-info">Registrar</button>
            </div>
        </div>
    </div>
</div>