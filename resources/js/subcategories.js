const URL = "http://localhost/market/"

$(document).on('change', '#department', function() {
	$.ajax({
		type: "POST",
		url: URL + "subcategory/getCategories",
		data: "id_department=" + $('#department').val(),
		success: function(data) {
			$('#categories').html(data);
		}
	});
});