<div class="container">
	<div class="row">
		<div class="col-12 col-md-6">
			<form method="POST" action="<?php echo constant('URL'); ?>mark/edit">
				<label>Nombre anterior</label>
				<input type="text" name="mark" class="form-control" value="<?php echo $this->error['mark']; ?>" readonly>
				
				<label>Nuevo nombre</label>
				<input type="text" name="new_mark" class="form-control <?php echo $this->error['c1']; ?>" value="<?php echo $this->error['new_mark']; ?>" required>
				<div class="invalid-feedback">
					<?php echo $this->error['m1']; ?>
				</div>

				<input type="hidden" name="id_mark" value="<?php echo $this->error['id_mark'] ?>">
				
				<input type="submit" value="Actualizar marca">
			</form>
		</div>
	</div>
</div>