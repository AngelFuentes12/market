<div id="content" class="container-fluid p-5">
    <section class="py-3">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-8 form-color p-4 shadow-sm">
                    <h4 class="pb-1">Pagína de categoria</h4>
                    <div class="row mb-3">
                        <div class="col-xl-12 col-lg-13">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col"><small class="font-weight-bold">Nombre de categoria<small></th>
                                            <th scope="col"><small class="font-weight-bold">Eliminar<small></th>
                                            <th scope="col"><small class="font-weight-bold">Configuraciones<small></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="">
                                            <td><span class="">Ropa</span></td>
                                            <td class="align-middle"><a href="#" class="status-span badge-primary badge-delete"><i class="fas fa-trash-alt"></i></a></td>
                                            <td class="align-middle"><a href="#" class="status-span badge-secondary">Editar <i class="fas fa-cog"></i></a></td>
                                        </tr>
                                        <tr class="">
                                            <td><span class="">Calzado</span></td>
                                            <td class="align-middle"><a href="#" class="status-span badge-primary badge-delete"><i class="fas fa-trash-alt"></i></a></td>
                                            <td class="align-middle"><a href="#" class="status-span badge-secondary">Editar <i class="fas fa-cog"></i></a></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <a href="#" class="status-span badge-primary badge-active" data-toggle="modal" data-target="#exampleModalCenter"><i class="fas fa-plus"></i></a>
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
                <h5 class="modal-title title-register" id="exampleModalLongTitle"><?= $_SESSION['name']; ?>, registra una categoria</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="color: red;">&times;</span>
                </button>
            </div>
            <div class="modal-body mx-auto">
                <p class="">Los campos marcados con un <small style="color: red;">*</small> son obligatorios</p>
                <form method="POST" action="">
                    <div class="form-group">
                        <label for="categoria" class="categoria">Categoria <span style="color: red;">*</span></label>
                        <input type="text" value="" name="categoria" class="form-control" required>
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