const URL = "http://localhost/market/";


$(document).on('change', '#category', function () {
	var id_category = $('#category').val();
	$.ajax({
		url: URL + "subcategories/getSubcategoriesSpecific",
		type: 'POST',
		data: {id_category: id_category},
	})
	.done(function(data) {
		$("#subcategories").html(data);
	})
	.fail(function() {
		alert("error");
	});
});