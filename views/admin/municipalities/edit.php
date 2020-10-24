	<div class="container">
		<div class="row">
			<div class="col-md-8 mx-auto">
				<form action="<?= constant('URL'); ?>municipalities/edit" method="POST">
					<?php 
						require_once 'models/admin/municipality.php';
						foreach ($this->municipalities as $row): 
							$municipality = new Municipality();
							$municipality = $row;
					?>
					<div>
						<label  for="state" >Estado</label>
						<input id="state" type="text" name="state" value="<?= $municipality->state; ?>" readonly required>
					</div>

					<div>
						<label for="municipality">Municipio</label>
						<input id="municipality" type="text" name="municipality" value="<?= $municipality->municipality; ?>">
					</div>
					<input type="hidden" name="id_state" value="<?= $municipality->id_state; ?>" required>
					<input type="hidden" name="id_municipality" value="<?= $municipality->id_municipality; ?>" required>
					<input type="submit" name="Actualizar">
					<?php endforeach ?>
				</form>
			</div>
		</div>
	</div>