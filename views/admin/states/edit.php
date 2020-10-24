	<div id="content" class="container-fluid p-5">
		<section class="py-3">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-12 col-md-6 form-color p-4 shadow-sm">
						<h4 class="py-2 font-weight-bold">Editar Información</h4>
						<form action="<?= constant('URL'); ?>states/edit" method="POST">
							<?php
							require_once 'models/admin/state.php';
							foreach ($this->states as $row) :
								$state = new State();
								$state = $row;
							?>
								<div class="from-group mb-3">
									<label for="state" class="font-weight-bold pt-3">
										Estado
									</label>

									<input id="state" type="text" name="state" class="form-control" value="<?= $state->state; ?>"  maxlength="20" minlength="5" required>
								</div>

								<div class="form-group mx-auto">
									<input type="hidden" name="id" value="<?= $state->id_state; ?>" readonly required>

									<input type="submit" class="btn btn-info" value="Actualizar">

									<a href="<?= constant('URL'); ?>states" class="btn btn-danger btn-cancel">
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