$(document).ready(function () {
    $('.btn-edit').click(function () {
        const serverId = $(this).data('server-id');

        // Realizar una solicitud AJAX para obtener los datos del servidor
        $.ajax({
            type: 'GET',
            url: '/server/edit/' + serverId,
            dataType: 'json',
            success: function (data) {
                if (data.server) {
                    const server = data.server;
                    const ip_parts = server.serverip.split('.');

                    const form = `
                        <form id="edit-server-form" method="POST"  action="/server/edit/${server.id}">
                        <div class="mt-4">
                            <label for="name">Nombre del Servidor:</label>
                            <input id="name" class="block mt-1 w-full" type="text" name="name" value="${server.servername}" required autofocus autocomplete="name" />
                        </div>
                            <div class="mt-4">
                                <label for="serverip">IP del Servidor:</label>
                            </div>
                            <div>
                                <input class="mr-2" type="number" name="ip_part1" value="${ip_parts[0]}" min="1" max="255" required />
                                <label>.</label>
                                <input class="mr-2" type="number" name="ip_part2" value="${ip_parts[1]}" min="0" max="255" required />
                                <label>.</label>
                                <input class="mr-2" type="number" name="ip_part3" value="${ip_parts[2]}" min="0" max="255" required />
                                <label>.</label>
                                <input class="mr-2" type="number" name="ip_part4" value="${ip_parts[3]}" min="0" max="255" required />
                            </div>
                            <div class="mt-4">
                                <label for="description">Descripción:</label>
                                <textarea id="description" class="block mt-1 w-full" name="description" rows="3">${server.description}</textarea>
                            </div>
                        </form>
                    `;

                    Swal.fire({
                        title: 'Editar Servidor',
                        html: form,
                        showCancelButton: true,
                        showConfirmButton: true,
                        cancelButtonText: 'Cancelar',
                        confirmButtonText: 'Editar',
                        customClass: {
                            popup: 'edit-sweetalert-popup'
                        },
                    }).then((result) => {
                        if (result.isConfirmed) {

                            const formElement = document.getElementById('edit-server-form'); // Obtener el formulario

                            const formData = new FormData(formElement);
                            var token = $('input[name="_token"]').val();
                            formData.append('_token', token);
                            // Realizar una solicitud AJAX para actualizar los datos del servidor
                            $.ajax({
                                type: 'POST',
                                url: `/server/edit/${server.id}`,
                                data: formData,
                                dataType: 'json',
                                processData: false,
                                contentType: false,
                                success: function (response) {
                                    if (response.success) {
                                        Swal.fire('Éxito', 'El servidor se ha actualizado correctamente', 'success');
                                        window.location.reload();
                                    } else {
                                        if (response.errors) {
                                            var errorMessages = '';
                                            for (var fieldName in response.errors) {
                                                if (response.errors.hasOwnProperty(fieldName)) {
                                                    var errorMessage = response.errors[fieldName][0];
                                                    var errorType = fieldName.split('.')[1]; // Obtener el tipo de error

                                                    // Verificar si ya hemos mostrado un error de este tipo
                                                    if (!shownErrorTypes[errorType]) {
                                                        errorMessages += errorMessage + '<br>';
                                                        shownErrorTypes[errorType] = true;
                                                    }
                                                }
                                            }

                                            // Mostrar SweetAlert solo si hay errores para mostrar
                                            if (errorMessages) {
                                                Swal.fire({
                                                    title: 'Errores de Validación',
                                                    html: errorMessages,
                                                    icon: 'error'
                                                });
                                                window.location.reload();
                                            }
                                        } else {
                                            Swal.fire('Error', 'No se pudo actualizar el servidor', 'error');
                                            window.location.reload();
                                        }
                                    }
                                },
                                error: function (xhr, status, error) {
                                    Swal.fire('Error', 'No se pudo actualizar el servidor', 'error');
                                    window.location.reload();
                                }
                            });
                        } else if (result.isDismissed) {
                            // El usuario hizo clic en "Cancelar" y no es necesario realizar alguna accion.
                        }
                    });
                } else {
                    Swal.fire('Error', 'No se pudieron cargar los datos del servidor', 'error');
                    window.location.reload();
                }
            },
            error: function () {
                Swal.fire('Error', 'No se pudo cargar el formulario de edición', 'error');
                window.location.reload();
            }
        });
    });
});
