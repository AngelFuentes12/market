	<div class="container">
		<div class="row">
			<div class="col-12 col-md-6">
				<form method="POST" action="<?php echo constant('URL'); ?>auth/login">
					<input type="email" name="email" placeholder="Correo Electronico" required>
					<input type="password" name="password" placeholder="Contraseña" required>
					<input type="submit" value="Acceder">
				</form>
			</div>
		</div>
	</div>