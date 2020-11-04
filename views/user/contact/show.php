	<script src="https://www.google.com/recaptcha/api.js" async defer></script>

	<section id="login">
		<div class="container p-5">
			<div class="row justify-content-center">
				<div class="col-12 col-md-7 form-color p-4 shadow-sm">
					<form method="POST" action="<?= constant('URL'); ?>contact/send" class="js-validation" novalidate>
						<h3 class="text-login h3">Contactos</h3>
						
						<div class="form-group">
							<label for="name" class="nombre">Nombre(s) <span style="color: red;">*</span></label>
							<input type="text" value="<?= $this->error['name']; ?>" name="name" class="form-control <?= $this->error['c1']; ?>" required>

							<div class="invalid-feedback">
								<?= $this->error['m1']; ?>
							</div>

							<div class="invalid-feedback">Ingresa un nombre</div>
						</div>

						<div class="form-group">
							<label for="telephone" class="Telefono">Telefono <span style="color: red;">*</span></label>
							<input type="text" value="<?= $this->error['telephone']; ?>" name="telephone" class="form-control <?= $this->error['c2']; ?>" required>

							<div class="invalid-feedback">
								<?= $this->error['m2']; ?>
							</div>

							<div class="invalid-feedback">Ingresa un numero de telefono</div>
						</div>

						<div class="form-group">
							<label for="email" class="email">Correo Electronico <span style="color: red;">*</span></label>
							<input type="email" value="<?= $this->error['email']; ?>" name="email" class="form-control <?= $this->error['c3']; ?>" required>

							<div class="invalid-feedback">
								<?= $this->error['m3']; ?>
							</div>

							<div class="invalid-feedback">Ingresa un Correo electronico</div>
						</div>

						<div class="form-group">
							<label for="captcha" class="captcha">Captcha <span style="color: red;">*</span></label>
							<div class="g-recaptcha <?= $this->error['c4']; ?>" data-sitekey="<?= constant('PSS') ?>"></div>

							<div class="invalid-feedback">
								<?= $this->error['m4']; ?>
							</div>
						</div>

						<div class="form-group">
							<label for="description" class="nombre">Descripción <span style="color: red;">*</span></label>
							<textarea name="description" class="form-control <?= $this->error['c5']; ?>" required><?= $this->error['description']; ?></textarea>

							<div class="invalid-feedback">
								<?= $this->error['m5']; ?>
							</div>

							<div class="invalid-feedback">Ingresa una descripción</div>
						</div>
						
						<div class="form-group">
							<input type="submit" class="btn btn-login btn-block" value="Enviar">
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>

<script src="<?= constant('JS') ?>validations.js"></script>