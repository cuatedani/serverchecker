$(document).ready(function () {
    $('.btn-checkone').click(function () {
        const serverId = $(this).data('server-id');

        // Realiza una petición GET a la ruta 'server.checkone'
        $.ajax({
            type: 'GET',
            url: '/server/checkone/' + serverId,
            success: function (data) {
                // Cierra el SweetAlert de "Revisando..." cuando se completa la petición
                Swal.close();

                // Muestra el SweetAlert de éxito
                Swal.fire({
                    icon: 'success',
                    title: data.message,
                    showConfirmButton: false,
                    timer: 1500, // Cierra automáticamente después de 1 segundo
                    didClose: () => {
                        // Recarga la página después de que se cierre el SweetAlert
                        window.location.reload();
                    }
                });
            },
            error: function (xhr, status, error) {
                // Cierra el SweetAlert de "Revisando..." cuando se completa la petición
                Swal.close();

                // Muestra el SweetAlert de error
                Swal.fire({
                    icon: 'error',
                    title: status,
                    showConfirmButton: false,
                    timer: 1500, // Cierra automáticamente después de 1 segundo
                    didClose: () => {
                        // Recarga la página después de que se cierre el SweetAlert
                        window.location.reload();
                    }
                });
            }
        });
    });
});
