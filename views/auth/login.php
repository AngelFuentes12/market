	<section id="login">
		<div class="container p-5">
			<div class="row justify-content-center">
				<div class="col-12 col-md-4 form-color p-4 shadow-sm">
					<form method="POST" action="<?php echo constant('URL'); ?>auth/login">
						<h3 class="text-login h3">Identifícate</h3>
						<div class="form-group">
							<label for="email" class="email">Correo Electronico</label>
							<input type="email" value="<?php echo $this->error['email']; ?>" name="email" class="form-control <?php echo $this->error['c1']; ?>" required>
							<div class="invalid-feedback">
								<?php echo $this->error['m1']; ?>
							</div>
						</div>
						<div class="form-group">
							<label for="password" class="password">Contraseña</label>
							<a href="<?= constant('URL'); ?>auth/reset" class="recordar">¿Olvidaste tu contraseña?</a>
							<input type="password" name="password" class="form-control <?php echo $this->error['c2']; ?>" required>
							<div class="invalid-feedback">
								<?php echo $this->error['m2']; ?>
							</div>
						</div>
						<div class="form-group">
							<label for="captcha" class="captcha">Captcha</label>
						</div>
						<div class="form-group">
							<input type="submit" class="btn btn-login btn-block" value="Acceder">
						</div>
						<div class="sign-up p-3">
							¿No tienes una cuenta? <a href="<?= constant('URL'); ?>auth/register">Crear una aquí</a>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>