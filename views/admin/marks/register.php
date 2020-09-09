<div class="container">
	<div class="row">
		<div class="col-12 col-md-6">
			<form method="POST" action="<?php echo constant('URL'); ?>mark/register">
				<label>Marca</label>
				<input type="text" name="mark" class="form-control <?php echo $this->error['c1']; ?>" value="<?php echo $this->error['mark']; ?>" required>
				<div class="invalid-feedback">
					<?php echo $this->error['m1']; ?>
				</div>
				<input type="submit" value="Registrar marca">
			</form>
		</div>
	</div>
</div>