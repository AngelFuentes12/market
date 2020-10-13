	<section id="login">
		<div class="container p-5">
			<div class="row justify-content-center">
				<div class="col-12 col-md-7 form-color p-4 shadow-sm">
					<form method="POST" action="<?php echo constant('URL'); ?>auth/login">
						<h3 class="text-login h3">Contactos</h3>
						<!-- <p style="color:red">Recuerda que todos los campos son obligatorios</p> -->
						<div class="form-group">
							<label for="nombre" class="nombre">Nombre(s)</label>
							<input type="text" value="" name="nombre" class="form-control" required>
							<div class="invalid-feedback">
							</div>
						</div>
						<div class="form-group">
							<label for="Telefono" class="Telefono">Telefono</label>
							<input type="text" value="" name="Telefono" class="form-control" required>
							<div class="invalid-feedback">
							</div>
						</div>
						<div class="form-group">
							<label for="email" class="email">Correo Electronico</label>
							<input type="email" value="" name="email" class="form-control" required>
							<div class="invalid-feedback">
							</div>
						</div>
						<div class="form-group">
							<label for="captcha" class="captcha">Captcha</label>
						</div>
						<div class="form-group">
							<label for="desc" class="nombre">Descripción</label>
							<textarea name="desc" class="form-control"></textarea>
							<div class="invalid-feedback">
							</div>
						</div>
						
						<div class="form-group">
							<input type="submit" class="btn btn-login btn-block" value="Enviar">
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>