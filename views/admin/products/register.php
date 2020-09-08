

<div class="container p-5">
	<div class="row">
		<div class="col-4 offset-4">
            <div class="form-group">
                <h2>Registro de productos</h2>
            </div>
			<form method="POST" action="<?php echo constant('URL'); ?>product/register">
                <div class="form-group">
                    <label for="mark">Marca</label>
                    <select class="form-control is-invalid" >
                <?php
                    require_once 'models/admin/products.php';
                    foreach ($this->marks as $row):
                        $mark = new Marks();
                        $mark = $row;
                ?>
                        <option><?php echo $mark->name; ?></option>
                <?php endforeach ?>
                    </select>
                    <div class="invalid-feedback">
                        alert!
                    </div>
                </div>
                <?php if (sizeof($this->marks) > 0): ?>
                <div class="form-group ">
                    <label for="product">Nombre del producto</label>
                    <input type="text" name="" class="form-control is-invalid" required>
                    <div class="invalid-feedback">
                        alert!
                    </div>
                </div>
                <div class="form-group">
                    <label for="price">Precio</label>
                    <input type="text" name="" class="form-control is-invalid" required>
                    <div class="invalid-feedback">
                        alert!
                    </div>
                </div>
                <div class="form-group">
                    <label for="upc">Codigo</label>
                    <input type="text" name="" class="form-control is-invalid" required>
                    <div class="invalid-feedback">
                        alert!
                    </div>
                </div>
                <div class="form-group">
                    <label for="upc">Descripcion</label>
                    <textarea name="" class="form-control is-invalid" required></textarea>
                </div>
                <div class="form-group">
                    <label for="category">Categoria</label>
                    <select class="form-control is-invalid" >
                        <option>Example</option>
                    </select>
                    <div class="invalid-feedback">
                        alert!
                    </div>
                 </div>
                 <div class="form-group">
                    <label for="subcategory">Subcategoria</label>
                    <select class="form-control is-invalid" >
                        <option>Example</option>
                    </select>
                    <div class="invalid-feedback">
                        alert!
                    </div>
                 </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-success btn-block" value="Registrar">
                </div>
                <?php else: ?>
                <p>Aun no tienes marcas registrada, registra una <a href="<?php echo constant('URL'); ?>mark/index">aqui</a></p>
                <?php endif ?>
                
			</form>
		</div>
	</div>
</div>