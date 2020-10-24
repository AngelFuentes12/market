	<div id="content" class="container-fluid p-5">
		<section class="py-3">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-12 col-md-6 form-color p-4 shadow-sm">
						<h4 class="py-2 font-weight-bold">Editar Información</h4>
						<form action="<?= constant('URL'); ?>municipalities/edit" method="POST">
							<?php 
								require_once 'models/admin/municipality.php';
								foreach ($this->municipalities as $row): 
									$municipality = new Municipality();
									$municipality = $row;
							?>
							<div class="form-group">
								<label for="state" class="font-weight-bold pt-3">
									Estado
								</label>

								<input id="state" type="text" class="form-control" name="state" value="<?= $municipality->state; ?>" readonly required>
							</div>

							<div class="form-group">
								<label for="municipality" class="font-weight-bold pt-3">
									Municipio
								</label>

								<input id="municipality" type="text" class="form-control" name="municipality" value="<?= $municipality->municipality; ?>" maxlength="20" minlength="5" required>
							</div>

							<div class="form-group">
								<input type="hidden" name="id_state" value="<?= $municipality->id_state; ?>" readonly required>
								<input type="hidden" name="id_municipality" value="<?= $municipality->id_municipality; ?>" readonly required>

								<input type="submit" class="btn btn-info" value="Actualizar">

								<a href="<?= constant('URL'); ?>municipalities" class="btn btn-danger btn-cancel">
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