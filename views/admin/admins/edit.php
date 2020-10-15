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
						<input type="text" name="name" value="<?= $admin->nombre; ?>">
					</div>

					<div>
						Correo electronico
						<input type="email" name="email" value="<?= $admin->correo; ?>" readonly>
					</div>	

					<div>
						<input type="submit" class="btn btn-primary" value="Actualizar">
					</div>	
					<?php endforeach ?>
				</form>
			</div>
		</div>
	</div>