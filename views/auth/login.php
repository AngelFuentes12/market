	<script src="https://www.google.com/recaptcha/api.js"></script>

	<section id="login" class="registro">
	    <div class="container p-5">
	        <div class="row justify-content-center">
	            <div class="col-12 col-md-4 form-color p-4 border-login shadow-sm">
				<h3 class="text-login">Identifícate</h3>
	                <form method="POST" action="<?php echo constant('URL'); ?>auth/login">
	                    <div class="form-group">
	                        <label for="email" class="email">Correo Electronico <span style="color: red;">*</span></label>
	                        <input type="email" value="<?php echo $this->error['email']; ?>" name="email"
	                            class="form-control <?php echo $this->error['c1']; ?>" required>
	                        <div class="invalid-feedback">
	                            <?php echo $this->error['m1']; ?>
	                        </div>
	                    </div>

	                    <div class="form-group">
	                        <label for="password" class="password">Contraseña <span style="color: red;">*</span></label>
	                        <a href="<?= constant('URL'); ?>auth/reset" class="recordar">¿Olvidaste tu contraseña?</a>
	                        <input type="password" name="password" class="form-control <?php echo $this->error['c2']; ?>"
	                            required>
	                        <div class="invalid-feedback">
	                            <?php echo $this->error['m2']; ?>
	                        </div>
	                    </div>

	                    <div class="form-group">
	                        <label for="captcha" class="captcha">Captcha <span style="color: red;">*</span></label>
	                        <div class="g-recaptcha <?= $this->error['c3']; ?>" data-sitekey="<?= constant('PSS') ?>">
	                        </div>

	                        <div class="invalid-feedback">
	                            <?= $this->error['m3']; ?>
	                        </div>
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
	</section>