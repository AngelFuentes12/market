<div class="container-">
	<div class="row-">
		<div class="col-12 col-md-6">
			<?php 
				require_once 'models/admin/products.php';
				if (sizeof($this->marks) == 0): 
			?>
			<p>Aun no tienes marcas registradas, registra una <a href="<?php echo constant('URL'); ?>mark/index">aqui</a></p>	
			<?php else: ?>
			<table border="1">
				<tr>
					<td>Id</td>
					<td>Marca</td>
					<td>Fecha de registro</td>
					<td>Ultima actualizacion</td>
					<td colspan="2">Opciones</td>
				</tr>
				<?php 
					foreach ($this->marks as $row):
						$mark = new Marks();
						$mark = $row; 
				?>
				<tr>
					<td><?php echo $mark->id_mark; ?></td>
					<td><?php echo $mark->name; ?></td>
					<td><?php echo $mark->create_at; ?></td>
					<td><?php echo $mark->update_at; ?></td>
					<td>
						<form method="POST" action="<?php echo constant('URL'); ?>mark/store">
							<input type="hidden" name="id_mark" value="<?php echo $mark->id_mark; ?>">
							<input type="hidden" name="mark" value="<?php echo $mark->name; ?>">
							<button type="submit"><i class="fas fa-edit"></i></button>
						</form>
					</td>
					<td>
						<form method="POST" action="<?php echo constant('URL'); ?>mark/delete">
							<input type="hidden" name="id_mark" value="<?php echo $mark->id_mark; ?>">
							<button type="submit"><i class="fas fa-trash"></i></button>
						</form>
					</td>
				</tr>
				<?php endforeach ?>
			</table>
			<?php endif ?>
		</div>
	</div>
</div>