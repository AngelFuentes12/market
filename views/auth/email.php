	<script src="https://www.google.com/recaptcha/api.js"></script>
	
	<section id="login">
		<div class="container p-5">
			<div class="row justify-content-center">
				<div class="col-12 col-md-4 form-color p-4 shadow-sm">
					<form method="POST" action="<?php echo constant('URL'); ?>auth/password">
						<h3 class="text-login h3">Restablecer contraseña</h3>

						<div class="form-group">
							<label for="email" class="email">Correo Electronico</label>

							<input type="email" value="<?php echo $this->error['email']; ?>" name="email" class="form-control <?php echo $this->error['c1']; ?>" required readonly>

							<div class="invalid-feedback">
								<?php echo $this->error['m1']; ?>
							</div>
						</div>

						<div class="form-group">
							<label for="password" class="password">Nueva contraseña <span style="color: red;">*</span></label></label>
							
							<input type="password" name="password" class="form-control <?php echo $this->error['c2']; ?>" value="<?= $this->error['password']; ?>" maxlength="15" minlength="8" required>

							<div class="invalid-feedback">
								<?php echo $this->error['m2']; ?>
							</div>
						</div>

						<div class="form-group">
							<label for="confirmpassword" class="password">Repite tu contraseña <span style="color: red;">*</span></label></label>

							
							<input type="password" name="confirmpassword" class="form-control <?php echo $this->error['c3']; ?>" maxlength="15" minlength="8" required>

							<div class="invalid-feedback">
								<?php echo $this->error['m3']; ?>
							</div>
						</div>

						<div class="form-group">
							<label for="captcha" class="captcha">Captcha <span style="color: red;">*</span></label></label>
							<div class="g-recaptcha <?= $this->error['c4']; ?>" data-sitekey="<?= constant('PSS') ?>"></div>

							<div class="invalid-feedback">
								<?= $this->error['m4']; ?>
							</div>
						</div>

						<div class="form-group">
							<input type="hidden" name="token" value="<?= $this->error['token']; ?>" required>
							<input type="submit" class="btn btn-login btn-block" value="Cambiar contraseña">
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>