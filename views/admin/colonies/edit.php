	<div id="content" class="container-fluid p-5">
		<section class="py-3">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-12 col-md-6 form-color p-4 shadow-sm">
						<h4 class="py-2 font-weight-bold">Editar Información</h4>
						<form action="<?= constant('URL'); ?>colonies/edit" method="POST">
							<?php 
								require_once 'models/admin/colony.php';
								foreach ($this->colonies as $row): 
									$colony = new Colony();
									$colony = $row;
							?>
							<div class="form-group">
								<label for="state" class="font-weight-bold pt-3">
									Estado
								</label>

								<input id="state" type="text" class="form-control" name="state" value="<?= $colony->state; ?>" readonly required>
							</div>

							<div class="form-group">
								<label for="municipality" class="font-weight-bold pt-3">
									Municipio
								</label>

								<input id="municipality" type="text" class="form-control" name="municipality" value="<?= $colony->municipality; ?>" readonly required>
							</div>

							<div class="form-group">
								<label for="colony" class="font-weight-bold pt-3">
									Colonia
								</label>

								<input id="colony" type="text" class="form-control" name="colony" value="<?= $colony->colony; ?>" maxlength="20" minlength="5" required>
							</div>

							<div class="form-group">
								<input type="hidden" name="id_state" value="<?= $colony->id_state; ?>" readonly required>
								<input type="hidden" name="id_municipality" value="<?= $colony->id_municipality; ?>" readonly required>
								<input type="hidden" name="id_colony" value="<?= $colony->id_colony; ?>" readonly required>

								<input type="submit" class="btn btn-info" value="Actualizar">

								<a href="<?= constant('URL'); ?>colonies" class="btn btn-danger btn-cancel">
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