$(function(){
    $('#add').click(function(){
        var item = `
            <tr>
                <td>
                    <select class="custom-select is-invalid" required name="categories[]">
                        <option selected disabled value="">Categoria...</option>
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
                </td>

                <td>
                    <select class="custom-select is-invalid" required name="subcategories[]">
                        <option selected disabled value="">Subcategoria...</option>
                        <option value="">
                            
                        </option>
                    </select>

                    <div class="invalid-feedback">
                        alert!
                    </div>
                </td>

                <td>
                    <input type="text" name="upc[]" class="form-control is-invalid" required>
                    
                    <div class="invalid-feedback">
                        alert!
                    </div>
                </td>

                <td>
                    <input type="text" name="name[]" class="form-control is-invalid" required>

                    <div class="invalid-feedback">
                        alert!
                    </div>
                </td>

                <td>
                    <textarea class="form-control is-invalid" name="description[]" required></textarea>

                    <div class="invalid-feedback">
                        alert!
                    </div>
                </td>

                <td>
                    <input type="text" name="price[]" class="form-control is-invalid" required>

                    <div class="invalid-feedback">
                        alert!
                    </div>
                </td>

                <td>
                    <input type="text" name="stock[]" class="form-control is-invalid" required>

                    <div class="invalid-feedback">
                        alert!
                    </div>
                </td>

                <td>
                    <input type="file" name="image[]" class="form-control is-invalid" required>

                    <div class="invalid-feedback">
                        alert!
                    </div>
                </td>

                <td>
                    <button type="button"><i class="fas fa-trash"></i></button>
                </td>
            </tr>
        `;

        $("#list").append(item);
    });
});

$(function(){
    var id = ""
});