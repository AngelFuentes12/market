const URL = "http://localhost/market/";

function getSubcategories(x)
{
	$.ajax({
		url: URL + "index/getSubcategoriesSpecific",
		type: 'POST',
		data: {id_category: x},
	})
	.done(function(data) {
		$("#link"+x).html(data);
	})
	.fail(function() {
		alert("error");
	});
}