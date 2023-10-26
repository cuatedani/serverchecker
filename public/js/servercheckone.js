$(document).ready(function () {

    // Agrega un controlador de clic para el botón "Temporizador"
    $('#btn-check-one').click(function () {
        // Realiza una petición GET a la ruta 'server.checkone'
        $.ajax({
            type: 'GET', // Utiliza el método GET
            url: '/server/checkone', // La URL de la ruta CheckOne
            success: function (data) {
                Swal.fire({
                    icon: 'success',
                    title: data.message,
                    showConfirmButton: true
                });
                window.location.reload();
            },
            error: function (xhr, status, error) {
                Swal.fire({
                    icon: 'error',
                    title: status,
                    showConfirmButton: true
                });
                window.location.reload();
            }
        });
    });
});