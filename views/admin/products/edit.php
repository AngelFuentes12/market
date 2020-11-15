	<div id="content" class="container-fluid py-5">
		<section class="">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-12 col-md-6 form-color p-4 shadow-sm">
						<h4 class="py-2 font-weight-bold">Editar Información</h4>
						<form action="<?= constant('URL'); ?>products/edit" method="POST" enctype="multipart/form-data" class="js-validation" novalidate>
							<?php
							require_once 'models/admin/vendor.php';
							foreach ($this->products as $row) :
								$product = new Product();
								$product = $row;
							?>
								<div class="form-group">
		                            <label for="vendor" class="font-weight-bold pt-3">
		                            	Proveedor
		                            </label>
		                            
		                            <select id="vendor" class="form-control" name="id_vendor" required>
		                                <option disabled value="">Seleccionar...</option>
		                                <?php 
		                                    require_once 'models/admin/vendor.php';
		                                    foreach ($this->vendors as $row): 
		                                        $vendor = new Vendor();
		                                        $vendor = $row;
		                                ?>
		                                <?php if ($product->id_vendor == $vendor->id_vendor): ?>
		                                <option value="<?= $vendor->id_vendor; ?>" selected>
		                                    <?= $vendor->vendor; ?> --- <?= $vendor->name; ?>
		                                </option>	
		                                <?php else: ?>
		                                <option value="<?= $vendor->id_vendor; ?>">
		                                    <?= $vendor->vendor; ?> --- <?= $vendor->name; ?>
		                                </option>	
		                                <?php endif ?>
		                                <?php endforeach ?>
		                            </select>

		                            <div class="invalid-feedback">
		                                Elige un proveedor
		                            </div>
		                        </div>

								<div class="from-group">
									<label for="product" class="font-weight-bold pt-3">
										Producto
									</label>

									<input id="product" type="text" name="product" class="form-control" value="<?= $product->product; ?>" minlength="3" maxlength="20" required>
								
									<div class="invalid-feedback">
										Ingresa un producto
									</div>
								</div>

								<div class="from-group">
									<label for="cost" class="font-weight-bold pt-3">
										Costo
									</label>

									<input id="cost" type="text" name="cost" class="form-control" value="<?= $product->cost; ?>" minlength="3" maxlength="20" required>

									<div class="invalid-feedback">
										Ingresa un costo
									</div>
								</div>

								<div class="form-group">
									<label for="description" class="font-weight-bold pt-3">
										Descripcion
									</label>

									<textarea id="description" name="description" class="form-control" required><?= $product->description; ?></textarea>

									<div class="invalid-feedback">
										Ingrese una descripcion
									</div>
								</div>

								<div class="form-group">
		                            <label for="image" class="font-weight-bold">
		                                Imagen
		                            </label>

		                            <input id="image" type="file" class="form-control>" name="image">
		                        </div>

								<div class="form-group mx-auto mt-4">
									<input type="hidden" name="id_product" value="<?= $product->id_product; ?>">
									<input type="hidden" name="image" value="<?= $product->image; ?>">
									<input type="submit" class="btn btn-info" value="Actualizar">

									<a href="<?= constant('URL'); ?>products" class="btn btn-danger btn-cancel">Cancelar</a>
								</div>
							<?php endforeach ?>
						</form>
					</div>
				</div>
			</div>
		</section>
	</div>