$(document).ready(function () {
    // Agrega un controlador de clic para el botón "Temporizador"
    $('#btn-check-one').click(function () {

        // Muestra un SweetAlert de "Revisando..."
        Swal.fire({
            title: 'Revisando...',
            imageUrl: 'https://assets-v2.lottiefiles.com/a/31b6eec0-1171-11ee-a93a-c70638485918/0SoVOdzJAg.gif',
            imageWidth: 400,
            imageHeight: 400,
            imageAlt: 'Loading',
            allowOutsideClick: false, // Evita que el usuario haga clic fuera del cuadro
            allowEscapeKey: false, // Evita que el usuario cierre el cuadro presionando Esc
            showConfirmButton: false, // No muestra el botón de confirmación
            onBeforeOpen: () => {
                Swal.showLoading(); // Muestra el ícono de carga
            }
        });

        // Realiza una petición GET a la ruta 'server.checkone'
        $.ajax({
            type: 'GET',
            url: '/server/checkone',
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
