	<div id="content" class="container-fluid p-5">
		<section class="py-3">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-12 col-md-6 form-color p-4 shadow-sm">
						<h4 class="py-2 font-weight-bold">Editar Información</h4>
						<form action="<?= constant('URL'); ?>postcodes/edit" method="POST" class="js-validation" novalidate>
							<?php 
								require_once 'models/admin/postcode.php';
								foreach ($this->postcodes as $row): 
									$postcode = new Postcode();
									$postcode = $row;
							?>
							<div class="from-group">
								<label for="state" class="font-weight-bold pt-3">
									Estado
								</label>

								<input id="state" type="text" class="form-control" name="state" value="<?= $postcode->state; ?>" readonly required>
							</div>

							<div class="from-group">
								<label for="municipality" class="font-weight-bold pt-3">
									Municipio
								</label>

								<input id="municipality" type="text" class="form-control" name="municipality" value="<?= $postcode->municipality; ?>" readonly required>
							</div>

							<div class="from-group">
								<label for="colony" class="font-weight-bold pt-3">
									Colonia
								</label>

								<input id="colony" type="text" class="form-control" name="colony" value="<?= $postcode->colony; ?>" readonly required>
							</div>

							<div class="from-group mb-3">
								<label for="postcode" class="font-weight-bold pt-3">
									Codigo Postal
								</label>

								<input id="postcode" type="text" class="form-control" name="postcode" value="<?= $postcode->postcode; ?>" maxlength="5" minlength="5" required>
									
								<div class="invalid-feedback"><?= $_SESSION['name']; ?>, Ingresa un codigo postal</div>
							</div>

							<div class="form-group mx-auto">
								<input type="hidden" name="id_state" value="<?= $postcode->id_state; ?>" readonly required>
								<input type="hidden" name="id_municipality" value="<?= $postcode->id_municipality; ?>" readonly required>
								<input type="hidden" name="id_colony" value="<?= $postcode->id_colony; ?>" readonly required>
								<input type="hidden" name="id_postcode" value="<?= $postcode->id_postcode; ?>" readonly required>

								<input type="submit" class="btn btn-info" value="Actualizar">

								<a href="<?= constant('URL'); ?>postcodes" class="btn btn-danger btn-cancel">
									Cancelar
								</a>
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