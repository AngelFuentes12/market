	<script src="https://www.google.com/recaptcha/api.js"></script>

	<section id="reset" class="py-5">
		<div class="container p-5">
			<div class="row justify-content-center">
				<div class="col-12 col-md-8 form-color p-4 shadow-sm">
				<form method="POST" action="<?= constant('URL'); ?>auth/resetpassword">
					<div class="form-group">
						<label for="email" class="title-email">Correo Electronico <span style="color: red;">*</span></label>

						<input type="email" value="<?= $this->error['email']; ?>" name="email" class="form-control <?= $this->error['c1']; ?>" required>

						<div class="invalid-feedback">
							<?= $this->error['m1']; ?>
						</div>
					</div>

					<div class="form-group">
						<label for="captcha" class="captcha">Captcha <span style="color: red;">*</span></label></label>
						<div class="g-recaptcha <?= $this->error['c2']; ?>" data-sitekey="<?= constant('PSS') ?>"></div>

						<div class="invalid-feedback">
							<?= $this->error['m2']; ?>
						</div>
					</div>

					<div class="form-group">
						<input type="submit" class="btn btn-login btn-block" value="Restablecer contraseña">
					</div>
				</form>	
				</div>
			</div>
		</div>
	</section>