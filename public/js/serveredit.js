$(document).ready(function () {
    $('.btn-edit').click(function () {
        const serverId = $(this).data('server-id');

        // Realizar una solicitud AJAX para obtener los datos del servidor
        $.ajax({
            type: 'GET',
            url: '/server/get/' + serverId,
            dataType: 'json',
            success: function (data) {
                if (data.server) {
                    const server = data.server;
                    const ip_parts = server.serverip.split('.');

                    const form = `
                        <div class="container">
                            <form id="edit-server-form">
                                <!-- Nombre del Servidor -->
                                <div class="form-group">
                                    <label class="form-label">Nombre del Servidor : </label>
                                    <input id="name" class="form-control" type="text" name="name" value="${server.servername}" required autofocus autocomplete="name"
                                        minlength="4" maxlength="25" />
                                    <div class="invalid-feedback">Por favor ingresa un nombre de entre 4 y 25 caracteres.</div>
                                </div>
            
                                <!-- Campos de la IP -->
                                <div class="form-group mt-4">
                                    <label class="form-label">IP del Servidor : </label>
                                    <div class="input-group">
                                        <input class="form-control" type="number" name="ip_part1" value="${ip_parts[0]}" min="1"
                                            max="255" required />
                                        <div id="validationip_part1" class="invalid-feedback">
                                            Por favor ingresa una direccion entre 1 y 255.
                                        </div>
                                        <span class="input-group-text" id="basic-addon1">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                                class="bi bi-dot" viewBox="0 0 16 16">
                                                <path d="M8 9.5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z"></path>
                                            </svg>
                                        </span>
                                        <input class="form-control" type="number" name="ip_part2" value="${ip_parts[1]}" min="0"
                                            max="255" required />
                                        <div id="validationip_part2" class="invalid-feedback">
                                            Por favor ingresa una direccion entre 0 y 255.
                                        </div>
                                        <span class="input-group-text" id="basic-addon1">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                                class="bi bi-dot" viewBox="0 0 16 16">
                                                <path d="M8 9.5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z"></path>
                                            </svg>
                                        </span>
                                        <input class="form-control" type="number" name="ip_part3" value="${ip_parts[2]}" min="0"
                                            max="255" required />
                                        <div id="validationip_part3" class="invalid-feedback">
                                            Por favor ingresa una direccion entre 0 y 255.
                                        </div>
                                        <span class="input-group-text" id="basic-addon1">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                                class="bi bi-dot" viewBox="0 0 16 16">
                                                <path d="M8 9.5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z"></path>
                                            </svg>
                                        </span>
                                        <input class="form-control" type="number" name="ip_part4" value="${ip_parts[3]}" min="0"
                                            max="255" required />
                                        <div id="validationip_part4" class="invalid-feedback">
                                            Por favor ingresa una direccion entre 0 y 255.
                                        </div>
                                    </div>
                                </div>
            
                                <!-- Descripción -->
                                <div class="form-group mt-4">
                                    <label for="description" class="form-label"> Descripción : </label>
                                    <textarea id="description" minlength="5" class="form-control" name="description" rows="3" required minlength="4"
                                        maxlength="200">${server.description}</textarea>
                                    <div class="invalid-feedback">Por favor ingresa una descripcion de entre 4 y 200 caracteres.</div>
                                </div>
                                <div class="col-12 text-center mt-3" style="display: none;" id="submitButtonContainer">
                                    <button class="btn btn-primary" type="submit" id="submitButton">Editar</button>
                                </div>
                            </form>
                        </div>
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
                        preConfirm: () => {
                            const formElement = document.getElementById('edit-server-form');
                            const submitButton = document.getElementById('submitButton');
                            submitButton.click();
                            if (formElement.checkValidity()) {
                                const formData = new FormData(formElement);
                                formData.append('_token', $('input[name="_token"]').val());

                                return $.ajax({
                                    type: 'POST',
                                    url: `/server/edit/${server.id}`,
                                    data: formData,
                                    dataType: 'json',
                                    processData: false,
                                    contentType: false
                                }).then((response) => {
                                    if (response.success) {
                                        Swal.fire('Éxito', 'El servidor se ha actualizado correctamente', 'success');
                                    } else {
                                        const errorMessages = Object.values(response.errors).flat().join('<br>');
                                        Swal.fire({
                                            title: 'Errores de Validación',
                                            html: errorMessages,
                                            icon: 'error'
                                        });
                                    }
                                }).catch(() => {
                                    Swal.fire('Error', 'No se pudo actualizar el servidor', 'error');
                                });
                            } else {
                                Swal.showValidationMessage('Por favor, complete todos los campos correctamente.');
                            }
                        }
                    });
                } else {
                    Swal.fire('Error', 'No se pudieron cargar los datos del servidor', 'error');
                }
            },
            error: function () {
                Swal.fire('Error', 'No se pudo cargar el formulario de edición', 'error');
            }
        });
    });
});
