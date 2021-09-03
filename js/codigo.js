$(document).ready(function() {
    $("form").each(function() {
        if ($(this).attr('id') == "cargarRopaSucia") {
            $(this).bind("submit", function(event) {
                var r = window.confirm("estas seguro que deseas borrar las cantidades de ropa hospitalaria");
                if (r == false) {
                    event.preventDefault();
                }
            });
        } else if ($(this).attr('id') == "eliminarPrendas") {
            $(this).bind("submit", function(event) {
                var r = window.confirm("estas seguro que deseas borrar la ropa hospitalaria");
                if (r == false) {
                    event.preventDefault();
                }
            });
        }
    });
});

$('#btnEnviarEmail').click(function() {
    var esperar = 3000;
    $.ajax({
        url: "contrasenia.php",
        beforeSend: function() {
            $('#contenido').text("Cargando...");
        },
        success: function(data) {
            setTimeout(function() {
                $('#contenido').html(data);
            }, esperar);
        }
    });
});