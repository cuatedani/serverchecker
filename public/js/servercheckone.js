function RevisionUnitaria(serverId) {
    const spnCheckOne = document.querySelector('#spn-check-one-' + serverId);
    var div = document.getElementById('card-' + serverId);
    // Inhabilitar Botones
    $('.btn-checkone').prop('disabled', true);

    // Ocultar Icono
    $('#icon-check-one-' + serverId).hide();

    // Mostrando el spinner de btnCheckOne
    spnCheckOne.removeAttribute('hidden');

    mostrarToast("info", "Checking", "Comprobando Servidor");
    divAnimacion(serverId);
    var estado = document.getElementById('estatus-' + serverId);
    var info1 = document.getElementById('info1-' + serverId);
    var info2 = document.getElementById('info2-' + serverId);
    var info3 = document.getElementById('info3-' + serverId);
    var info4 = document.getElementById('info4-' + serverId);
    var info5 = document.getElementById('info5-' + serverId);
    var divestado = document.getElementById('div-estatus-' + serverId);

    // Realiza una petición GET a la ruta 'server.checkone'
    $.ajax({
        type: 'GET',
        url: '/server/checkone/' + serverId,
        success: function (data) {
            estado.innerHTML = 'ESTE SERVIDOR ESTA ' + data.estatus;
            info1.innerHTML = 'Dirección Ip: ' + data.info1;
            info2.innerHTML = 'Tiempo en Estado: ' + data.info2;
            info3.innerHTML = 'Ultima Revisión: ' + data.info3;
            info4.innerHTML = 'Inicio de Estado: ' + data.info4;
            info5.innerHTML = 'Descripción: ' + data.info5;

            if (data.estatus == 'Activo') {
                div.classList.remove('border-warning');
                div.classList.remove('pulse');
                divestado.classList.remove('alert-warning');
                divestado.classList.add('alert-success');
                // Ocultando el spinner de btnCheckAll
                spnCheckOne.setAttribute('hidden', 'true');
                // Mostrar el icono
                $('#icon-check-one-' + serverId).show();
                habilitarBotones();

                mostrarToast("success", "!Servidor operativo...");
            } else {
                div.classList.remove('border-warning');
                div.classList.remove('pulse');
                divestado.classList.remove('alert-warning');
                divestado.classList.add('alert-danger');
                // Ocultando el spinner de btnCheckAll
                spnCheckOne.setAttribute('hidden', 'true');
                // Mostrar el icono
                $('#icon-check-one-' + serverId).show();
                habilitarBotones();
                mostrarToast("error", "!Servidor fuera de linea...");
            }
        },
        error: function (xhr, status, error) {
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
}

function divAnimacion(serverId) {
    const botones = document.querySelectorAll('.btn-checkone');
    var div = document.getElementById('card-' + serverId);
    var estado = document.getElementById('estatus-' + serverId);
    var divestado = document.getElementById('div-estatus-' + serverId);

    div.classList.add('border-warning');
    div.classList.add('pulse');

    estado.innerHTML = 'Revisando el estado del servidor';
    divestado.classList.remove('alert-danger');
    divestado.classList.remove('alert-success');
    divestado.classList.add('alert-warning');

    botones.forEach(function (boton) {
        // Deshabilitamos el botón
        boton.disabled = true;
    });
}

function habilitarBotones() {
    const botones = document.querySelectorAll('.btn-checkone');
    botones.forEach(function (boton) {
        // Hbilitamos el botón
        boton.disabled = false;
    });
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

$(document).ready(function () {
    $('.btn-checkone').click(function () {
        const serverId = $(this).data('server-id');
        RevisionUnitaria(serverId);
    });
});

export { RevisionUnitaria };