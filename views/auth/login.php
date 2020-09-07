<div class="container p-5">
	<div class="row">
		<div class="col-4 offset-4">
			<form method="POST" action="<?php echo constant('URL'); ?>auth/login">
				<div class="form-group">
					<label for="email">Correo Electronico</label>
					<input type="email" name="email" class="form-control" required>
				</div>
				<div class="form-group">
					<label for="password">Contraseña</label>
					<a href="#" style="float:right;font-size:12px;">¿Olvidaste tu contraseña?</a>
					<input type="password" name="password" class="form-control" required>
				</div>
				<div class="form-group">
					<input type="submit" class="btn btn-success btn-block" value="Acceder">
				</div>
				<div class="sign-up p-3">
					¿No tienes una cuenta? <a href="#">Crear una aquí</a>
				</div>
			</form>
		</div>
	</div>
</div>