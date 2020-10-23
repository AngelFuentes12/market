const URL = "http://localhost/market/";


$(document).on('change', '#state', function () {
	var id_state = $('#state').val();
	$("#colonies").html('<select id="colony" class="form-control" name="id_colony" required><option selected>Seleccionar...</option>"</select>');
	$("#postcodes").html('<select id="postcode" class="form-control" name="id_postcode" required><option selected>Seleccionar...</option>"</select>');
	
	$.ajax({
		url: URL + "colonies/getMunicipalities",
		type: 'POST',
		data: {id_state: id_state},
	})
	.done(function(data) {
		$("#municipalities").html(data);
	})
	.fail(function() {
		alert("error");
	});
});

$(document).on('change', '#municipality', function () {
	var id_municipality = $('#municipality').val();
	$("#postcodes").html('<select id="postcode" class="form-control" name="id_postcode" required><option selected>Seleccionar...</option>"</select>');

	$.ajax({
		url: URL + "postcodes/getColonies",
		type: 'POST',
		data: {id_municipality: id_municipality},
	})
	.done(function(data) {
		$("#colonies").html(data);
	})
	.fail(function() {
		alert("error");
	});
});

$(document).on('change', '#colony', function () {
	var id_colony = $('#colony').val();

	$.ajax({
		url: URL + "postcodes/getPostcode",
		type: 'POST',
		data: {id_colony: id_colony},
	})
	.done(function(data) {
		$("#postcodes").html(data);
	})
	.fail(function() {
		alert("error");
	});
});