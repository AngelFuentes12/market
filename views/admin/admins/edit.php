	<div id="content" class="container-fluid py-5">
		<section class="">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-12 col-md-10 form-color p-4 shadow-sm">
						<h4 class="py-2 font-weight-bold">Editar Información</h4>
						<form action="<?= constant('URL'); ?>admins/edit" method="POST" class="js-validation" novalidate>
							<?php
							require_once 'models/admin/admin.php';
							foreach ($this->admins as $row) :
								$admin = new Admin();
								$admin = $row;
							?>
								<div class="from-group">
									<label for="name" class="name font-weight-bold pt-3">
										Nombre
									</label>

									<input type="text" name="name" class="form-control" value="<?= $admin->name; ?>" minlength="3" maxlength="20" required>
									
									<div class="invalid-feedback"><?= $_SESSION['name']; ?>, Ingresa un Nombre</div>
								</div>

								<div class="form-group">
									<label for="email" class="email font-weight-bold pt-3">
										Correo Electronico
									</label>

									<input type="email" name="email" class="form-control" value="<?= $admin->email; ?>" readonly required>
									<div class="invalid-feedback"><?= $_SESSION['name']; ?>, Ingresa un Correo Electronico</div>
								</div>

								<div class="form-group">
									<label for="user" class="user font-weight-bold">
										Tipo usuario
									</label>

									<input type="text" name="type_user" class="form-control" value="<?= ($admin->level == 1) ? 'Administrador' : ''; ?>" readonly required>
								</div>

								<div class="form-group">
									<label for="status" class="status font-weight-bold">
										Status
									</label>

									<?php
										$type = '';
										if ($admin->status == 1) {
											$type = 'Activo';
										} else if ($admin->status == 2) {
											$type = 'Verificacion';
										} else if ($admin->status == 3) {
											$type = 'Suspendido';
										}
									?>

									<input type="text" name="status" class="form-control" value="<?= $type; ?>" readonly required>
								</div>

								<div class="form-group mx-auto">
									<input type="hidden" name="id" value="<?= $admin->id_user; ?>" readonly required>

									<input type="submit" class="btn btn-info" value="Actualizar">

									<a href="<?= constant('URL'); ?>admins" class="btn btn-danger btn-cancel">Cancelar</a>
								</div>
							<?php endforeach ?>
						</form>
					</div>
				</div>

			</div>
		</section>
	</div>

<!-- js validation -->
<script src="<?= constant('JS'); ?>validations.js"></script>