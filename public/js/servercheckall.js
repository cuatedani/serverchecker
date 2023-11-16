$(document).ready(function () {
    const botones = document.querySelectorAll('.btn-checkone');
    const spinners = document.querySelectorAll('.button-loading');
    const btnCheckAll = $('#btn-check-all');
    const spnCheckAll = document.querySelector('#spn-check-all');
    let index = 0; // Inicializamos el índice

    btnCheckAll.click(function () {
        // Deshabilitar el botón antes de iniciar el proceso
        $(this).prop('disabled', true);

        // Cambiar texto a "Checking..."
        $(this).find('.button-text').text("  Checking...");

        // Mostrando el spinner de btnCheckAll
        spnCheckAll.removeAttribute('hidden');

        index = 0; // Reiniciamos el índice al hacer clic en el botón
        deshabilitarBotones(); // Deshabilitamos todos los botones
        procesarBotones(); // Iniciamos el proceso
    });

    function deshabilitarBotones() {
        botones.forEach(function (boton) {
            // Deshabilitamos el botón
            boton.disabled = true;
        });
    }

    function habilitarBotones() {
        botones.forEach(function (boton) {
            // Hbilitamos el botón
            boton.disabled = false;
        });
    }

    const procesarBotones = () => {
        if (index < botones.length) {
            const boton = botones[index];
            const spinner = spinners[index];
            const serverId = boton.dataset.serverId;
            var estado = document.getElementById('estatus-' + serverId);
            
            var divestado = document.getElementById('div-estatus-' + serverId);
            var div = document.getElementById('card-' + serverId);

            divAnimacion(serverId)
            // Ocultamos el icono
            $(boton).find('.button-icon').hide();
            // Mostramos los spinners
            spinner.removeAttribute('hidden');

            // Realizamos la petición AJAX
            $.ajax({
                type: 'GET',
                url: '/server/checkone/' + serverId,
                success: function (data) {

                    estado.innerHTML = 'ESTE SERVIDOR ESTA ' + data.estatus;
                    if (data.estatus == 'Activo') {
                        // Mostramos el icono
                        $(boton).find('.button-icon').show();
                        // Ocultamos los spinners
                        spinner.setAttribute('hidden', 'true');
                        // Quitamos Animacion
                        div.classList.remove('border-warning');
                        div.classList.remove('pulse');
                        //Modificamos Alert
                        divestado.classList.remove('alert-warning');
                        divestado.classList.add('alert-success');
                    } else {
                        // Mostramos el icono
                        $(boton).find('.button-icon').show();
                        // Ocultamos los spinners
                        spinner.setAttribute('hidden', 'true');
                        // Quitamos Animacion
                        div.classList.remove('border-warning');
                        div.classList.remove('pulse');
                        //Modificamos Alert
                        divestado.classList.remove('alert-warning');
                        divestado.classList.add('alert-danger');
                    }
                    index++; // Pasamos al siguiente elemento
                    procesarBotones(); // Llamamos de nuevo a la función recursivamente
                },
                error: function (xhr, status, error) {
                    div.classList.remove('border-warning');
                    div.classList.remove('pulse');
                    // Muestra el SweetAlert de error
                    Swal.fire({
                        icon: 'error',
                        title: status,
                        showConfirmButton: false,
                        timer: 1500, // Cierra automáticamente después de 1 segundo
                    });

                    index++; // Pasamos al siguiente elemento
                    procesarBotones(); // Llamamos de nuevo a la función recursivamente
                }
            });
        } else {
            // Cuando se procesan todos los botones, mostramos el mensaje y recargamos la página después de 3 segundos
            habilitarBotones();

            mostrarToast("success", "!Exito¡ Todos los Servidores comprobados");

            // Habilitar el botón
            btnCheckAll.prop('disabled', false);

            //Scrolleo al terminar
            $('html, body').animate({ scrollTop: 0 }, 'slow'); // Scroll suave hacia arriba

            // Cambiar el texto a "Check"
            btnCheckAll.find('.button-text').text("Check");

            // Ocultando el spinner de btnCheckAll
            spnCheckAll.setAttribute('hidden', 'true');
        }
    };

    function divAnimacion(serverId) {
        var div = document.getElementById('card-' + serverId);
        var estado = document.getElementById('estatus-' + serverId);
        var divestado = document.getElementById('div-estatus-' + serverId);

        //Hacemos focus a la card
        div.focus();
        //activamos la animacion
        div.classList.add('border-warning');
        div.classList.add('pulse');

        // Cambiamos el alert
        estado.innerHTML = 'Revisando el estado del servidor';
        divestado.classList.remove('alert-danger');
        divestado.classList.remove('alert-success');
        divestado.classList.add('alert-warning');

    }

    function mostrarToast(icon, title) {
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        });
        Toast.fire({
            icon: icon,
            title: title
        });
    }
});