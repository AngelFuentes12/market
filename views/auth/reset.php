<div class="container p-5">
	<div class="row">
		<div class="col-4 offset-4">
			<form method="POST" action="<?= constant('URL'); ?>auth/resetpassword">
				<div class="form-group">
					<label for="email">Correo Electronico</label>
					<input type="email" value="<?= $this->error['email']; ?>" name="email" class="form-control <?= $this->error['c1']; ?>" required>
					<div class="invalid-feedback">
						<?= $this->error['m1']; ?>
					</div>
				</div>
				<div class="form-group">
					<input type="submit" class="btn btn-success btn-block" value="Restablecer contraseña">
				</div>
			</form>
		</div>
	</div>
</div>