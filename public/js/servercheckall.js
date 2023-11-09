$(document).ready(function () {
    const botones = document.getElementsByClassName('btn-checkone');
    let index = 0; // Inicializamos el índice

    $('#btn-check-all').click(function () {
        index = 0; // Reiniciamos el índice al hacer clic en el botón
        procesarBotones(); // Iniciamos el proceso
    });

    const procesarBotones = () => {
        if (index < botones.length) {
            const boton = botones[index];
            const idServer = boton.dataset.serverId;
            
            boton.scrollIntoView({ behavior: "smooth" });  //Hace Focus al boton

            Swal.fire({
                title: 'Revisando Server ' + idServer,
                imageWidth: 400,
                imageHeight: 400,
                imageAlt: 'Loading',
                allowOutsideClick: false,
                allowEscapeKey: false,
                showConfirmButton: false,
            });

            // Realizamos la petición AJAX
            $.ajax({
                type: 'GET',
                url: '/server/checkone/' + idServer,
                success: function (data) {
                    Swal.close();

                    Swal.fire({
                        icon: 'success',
                        title: data.message,
                        showConfirmButton: false,
                        timer: 1500,
                        didClose: () => {
                            index++; // Pasamos al siguiente botón
                            procesarBotones(); // Llamamos de nuevo a la función recursivamente
                        }
                    });
                },
                error: function (xhr, status, error) {
                    Swal.close();

                    Swal.fire({
                        icon: 'error',
                        title: status,
                        showConfirmButton: false,
                        timer: 1500,
                        didClose: () => {
                            index++; // Pasamos al siguiente botón
                            procesarBotones(); // Llamamos de nuevo a la función recursivamente
                        }
                    });
                }
            });
        } else {
            // Cuando se procesan todos los botones, recargamos la página
            Swal.fire({
                title: 'Servidores Comprobados',
                timer: 1500,
                allowOutsideClick: false,
                allowEscapeKey: false,
                showConfirmButton: false,
            });

            window.location.reload();
        }
    };
});
