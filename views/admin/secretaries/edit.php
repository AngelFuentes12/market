	<div class="container">
		<div class="row">
			<div class="col-md-8 mx-auto">
				<form action="<?= constant('URL'); ?>secretaries/edit" method="POST">
					<?php 
						require_once 'models/admin/secretary.php';
						foreach ($this->secretaries as $row): 
							$secretary = new Secretary();
							$secretary = $row;
					?>
					<div>
						Nombre
						<input type="text" name="name" value="<?= $secretary->name; ?>" required>
					</div>

					<div>
						Correo electronico
						<input type="email" name="email" value="<?= $secretary->email; ?>" readonly>
					</div>	

					<div>
						Tipo usuario
						<input type="text" name="type_user" value="<?= ($secretary->level == 2) ? 'Secretaria' : ''; ?>" readonly>
					</div>

					<div>
						Status
						<?php 
							$type = '';
							if ($secretary->status == 1) {
								 $type = 'Activo';
							} else if($secretary->status == 2) {
								 $type = 'Verificacion';
							} else if($secretary->status == 3) {
								 $type = 'Suspendido';
							}
						?>
						<input type="text" name="status" value="<?= $type; ?>" readonly>
					</div>

					<div>
						<input type="submit" class="btn btn-primary" value="Actualizar">
					</div>	
					<?php endforeach ?>
				</form>
			</div>
		</div>
	</div>