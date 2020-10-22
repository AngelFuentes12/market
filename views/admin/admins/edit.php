	<div class="container">
		<div class="row">
			<div class="col-md-8 mx-auto">
				<form action="" method="POST">
					<?php 
						require_once 'models/admin/admin.php';
						foreach ($this->admins as $row): 
							$admin = new Admin();
							$admin = $row;
					?>
					<div>
						Nombre
						<input type="text" name="name" value="<?= $admin->name; ?>">
					</div>

					<div>
						Correo electronico
						<input type="email" name="email" value="<?= $admin->email; ?>" readonly>
					</div>	

					<div>
						Tipo usuario
						<input type="text" name="type_user" value="<?= ($admin->level == 1) ? 'Administrador' : ''; ?>" readonly>
					</div>

					<div>
						Status
						<?php 
							$type = '';
							if ($admin->status == 1) {
								 $type = 'Activo';
							} else if($admin->status == 2) {
								 $type = 'Verificacion';
							} else if($admin->status == 3) {
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