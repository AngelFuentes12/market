	<div id="content" class="container-fluid p-5">
		<section class="py-3">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-12 col-md-6 form-color p-4 shadow-sm">
						<h4 class="py-2 font-weight-bold">Editar Información</h4>
						<form action="<?= constant('URL'); ?>subcategories/edit" method="POST" class="js-validation" novalidate>
							<?php 
								require_once 'models/admin/subcategory.php';
								foreach ($this->subcategories as $row): 
									$subcategory = new Subcategory();
									$subcategory = $row;
							?>
							<div class="form-group">
								<label for="category" class="font-weight-bold pt-3">
									Categoria
								</label>

								<input id="category" type="text" class="form-control" name="category" value="<?= $subcategory->category; ?>" readonly required>
							</div>

							<div class="form-group">
								<label for="subcategory" class="font-weight-bold pt-3">
									Subcategoria
								</label>

								<input id="subcategory" type="text" class="form-control" name="subcategory" value="<?= $subcategory->subcategory; ?>" maxlength="50" minlength="5" required>
							
								<div class="invalid-feedback">
									<?= $_SESSION['name']?>, Ingrese una subcategoria
								</div>
							</div>

							<div class="form-group">
								<input type="hidden" name="id_category" value="<?= $subcategory->id_category; ?>" readonly required>
								<input type="hidden" name="id_subcategory" value="<?= $subcategory->id_subcategory; ?>" readonly required>

								<input type="submit" class="btn btn-info" value="Actualizar">

								<a href="<?= constant('URL'); ?>subcategories" class="btn btn-danger btn-cancel">
									Cancelar
								</a>
							</div>
							<?php endforeach ?>
						</form>
					</div>
				</div>
			</div>
		</section>
	</div>

<!-- validación -->

<script src="<?= constant('JS'); ?>validations.js"></script>