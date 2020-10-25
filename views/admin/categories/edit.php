	<div id="content" class="container-fluid p-5">
		<section class="py-3">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-12 col-md-6 form-color p-4 shadow-sm">
						<h4 class="py-2 font-weight-bold">Editar Información</h4>
						<form action="<?= constant('URL'); ?>categories/edit" method="POST">
							<?php
							require_once 'models/admin/category.php';
							foreach ($this->categories as $row) :
								$category = new Category();
								$category = $row;
							?>
								<div class="from-group mb-3">
									<label for="category" class="font-weight-bold pt-3">
										Categoria
									</label>

									<input id="category" type="text" name="category" class="form-control" value="<?= $category->category; ?>"  maxlength="40" minlength="5" required>
								</div>

								<div class="form-group mx-auto">
									<input type="hidden" name="id" value="<?= $category->id_category; ?>" readonly required>

									<input type="submit" class="btn btn-info" value="Actualizar">

									<a href="<?= constant('URL'); ?>categories" class="btn btn-danger btn-cancel">
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