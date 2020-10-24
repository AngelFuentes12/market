$(document).ready( function () {
    $('#dataTable').DataTable( {
        language: {
            decimal:        "",
            processing:     "Procesando...",
            search:         "Buscar",
            emptyTable:     "No hay información disponible",
            info:           "Mostrando _START_ a _END_ de _TOTAL_ elementos",
            infoEmpty:      "Mostrando 0 a 0 de 0 elementos",
            infoFiltered:   "(Filtrado de _MAX_ total elementos)",
            infoPostFix:    "",
            thousands:      ",",
            lengthMenu:     "Mostrar _MENU_ elementos",
            loadingRecords: "Cargando...",
            search:         "Buscar:",
            zeroRecords:    "Sin resultados encontrados",
            paginate: {
                first:      "<<",
                previous:   "<",
                next:       ">",
                last:       ">>"
            }
        }
    });
});