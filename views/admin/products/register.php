

<div class="container p-5">
	<div class="row">
		<div class="col-4 offset-4">
            <div class="form-group">
                <h2>Registro de productos</h2>
            </div>
			<form method="POST" action="<?php echo constant('URL'); ?>auth/login">
                <div class="form-group">
                    <label for="mark">Marca</label>
                    <select class="form-control" >
                    <option>Example</option>
                    </select>
                 </div>
				<div class="form-group">
					<label for="product">Nombre del producto</label>
					<input type="text" name="" class="form-control" required>
				</div>
				<div class="form-group">
					<label for="price">Precio</label>
					<input type="text" name="" class="form-control" required>
                </div>
                <div class="form-group">
					<label for="upc">Codigo</label>
					<input type="text" name="" class="form-control" required>
				</div>
                <div class="form-group">
                    <label for="category">Categoria</label>
                    <select class="form-control" >
                    <option>Example</option>
                    </select>
                 </div>
                 <div class="form-group">
                    <label for="subcategory">Subcategoria</label>
                    <select class="form-control" >
                    <option>Example</option>
                    </select>
                 </div>
				<div class="form-group">
					<input type="submit" class="btn btn-success btn-block" value="Registrar">
				</div>
			</form>
		</div>
	</div>
</div>