	<div id="content" class="container-fluid py-5">
		<section class="">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-12 col-md-6 form-color p-4 shadow-sm">
						<h4 class="py-2 font-weight-bold">Editar Información</h4>
						<form action="<?= constant('URL'); ?>vendors/edit" method="POST">
							<?php
							require_once 'models/admin/vendor.php';
							foreach ($this->vendors as $row) :
								$vendor = new Vendor();
								$vendor = $row;
							?>
								<div class="from-group">
									<label for="vendor" class="font-weight-bold pt-3">
										Proveedor
									</label>

									<input id="vendor" type="text" name="vendor" class="form-control" value="<?= $vendor->vendor; ?>" minlength="3" maxlength="20" required>
								</div>

								<div class="from-group">
									<label for="name" class="font-weight-bold pt-3">
										Nombre
									</label>

									<input id="name" type="text" name="name" class="form-control" value="<?= $vendor->name; ?>" minlength="3" maxlength="20" required>
								</div>

								<div class="from-group">
									<label for="email1" class="font-weight-bold pt-3">
										Correo electronico
									</label>

									<input id="email1" type="email" name="email1" class="form-control" value="<?= $vendor->email1; ?>" readonly required>
								</div>

								<div class="from-group">
									<label for="email2" class="font-weight-bold pt-3">
										Correo electronico alternativo
									</label>

									<input id="email2" type="email" name="email2" class="form-control" value="<?= $vendor->email2; ?>" minlength="3" maxlength="30">
								</div>

								<div class="from-group">
									<label for="telephone" class="font-weight-bold pt-3">
										Telefono
									</label>

									<input id="telephone" type="text" name="telephone" class="form-control" value="<?= $vendor->telephone1; ?>" readonly required>
								</div>

								<div class="from-group">
									<label for="telephone2" class="font-weight-bold pt-3">
										Telefono alternativo
									</label>

									<input id="telephone2" type="text" name="telephone2" class="form-control" value="<?= $vendor->telephone2; ?>" minlength="10" maxlength="10">
								</div>

								<div class="from-group">
									<label for="state" class="font-weight-bold pt-3">
										Estado
									</label>

									<input id="state" type="text" name="state" class="form-control" value="<?= $vendor->state; ?>" readonly required>
								</div>

								<div class="from-group">
									<label for="state" class="font-weight-bold pt-3">
										Municipio
									</label>

									<input id="municipality" type="text" name="municipality" class="form-control" value="<?= $vendor->municipality; ?>" readonly required>
								</div>

								<div class="from-group">
									<label for="colony" class="font-weight-bold pt-3">
										Colonia
									</label>

									<input id="colony" type="text" name="colony" class="form-control" value="<?= $vendor->colony; ?>" readonly required>
								</div>

								<div class="from-group">
									<label for="postcode" class="font-weight-bold pt-3">
										Codigo postal
									</label>

									<input id="postcode" type="text" name="postcode" class="form-control" value="<?= $vendor->postcode; ?>" readonly required>
								</div>

								<div class="from-group">
									<label for="street" class="font-weight-bold pt-3">
										Calle
									</label>

									<input id="street" type="email" name="street" class="form-control" value="<?= $vendor->street; ?>" minlength="8" maxlength="40" required>
								</div>

								<div class="from-group">
									<label for="inside" class="font-weight-bold pt-3">
										Numero interior
									</label>

									<input id="inside" type="email" name="inside" class="form-control" value="<?= $vendor->inside; ?>" minlength="1" maxlength="4" required>
								</div>

								<div class="from-group">
									<label for="outside" class="font-weight-bold pt-3">
										Numero exterior
									</label>

									<input id="outside" type="email" name="outside" class="form-control" value="<?= $vendor->outside; ?>" minlength="1" maxlength="4" required>
								</div>

								<div class="form-group mx-auto mt-4">
									<input type="text" name="id_vendor" value="<?= $vendor->id_vendor; ?>" readonly required>
									<input type="text" name="id_direcction" value="<?= $vendor->id_direcction; ?>" readonly required>

									<input type="submit" class="btn btn-info" value="Actualizar">

									<a href="<?= constant('URL'); ?>vendors" class="btn btn-danger btn-cancel">Cancelar</a>
								</div>
							<?php endforeach ?>
						</form>
					</div>
				</div>

			</div>
		</section>
	</div>