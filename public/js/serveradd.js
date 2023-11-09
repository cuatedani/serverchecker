$(document).ready(function () {
    $('.btn-add').click(function () {
        // Realizar una solicitud AJAX para obtener datos necesarios o dejar en blanco para un nuevo servidor
        // Puedes agregar una solicitud similar a la que se hace para editar, pero para obtener datos vacíos o predeterminados

        const form = `
            <form id="add-server-form" method="POST"  action="/server/add">

                <!-- Nombre del Servidor -->
                <div class="form-group">
                    <label class="form-label">Nombre del Servidor : </label>
                    <input id="name" class="form-control" type="text" name="name"  required autofocus autocomplete="name" />
                </div>

                <!-- Campos de la IP -->
                <div class="form-group mt-4">
                    <label class="form-label">IP del Servidor : </label>
                    <div class="input-group">
                        <input class="form-control" type="number" name="ip_part1" value=" 'ip_part1' " min="1" max="255" required />
                        <span class="input-group-text">.</span>
                        <input class="form-control" type="number" name="ip_part2" value=" 'ip_part2' " min="0" max="255" required />
                        <span class="input-group-text">.</span>
                        <input class="form-control" type="number" name="ip_part3" value=" 'ip_part3' " min="0" max="255" required />
                        <span class="input-group-text">.</span>
                        <input class="form-control" type="number" name="ip_part4" value=" 'ip_part4' " min="0" max="255" required />
                    </div>
                </div>

                <!-- Descripción -->
                <div class="form-group mt-4">
                    <label for="description" class="form-label"> Descripción : </label>
                    <textarea id="description" minlength="5" class="form-control" name="description" rows="3"> </textarea>
                </div>

                
            </form>
        `;

        Swal.fire({
            title: 'Agregar Servidor',
            html: form,
            showCancelButton: true,
            showConfirmButton: true,
            cancelButtonText: 'Cancelar',
            confirmButtonText: 'Agregar',
            customClass: {
                popup: 'add-sweetalert-popup'
            },
        }).then((result) => {
            if (result.isConfirmed) {
                const formElement = document.getElementById('add-server-form'); // Obtener el formulario

                const formData = new FormData(formElement);
                var token = $('input[name="_token"]').val();
                formData.append('_token', token);

                // Realizar una solicitud AJAX para agregar un nuevo servidor
                $.ajax({
                    type: 'POST',
                    url: '/server/add',
                    data: formData,
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        Swal.fire('Éxito', 'El servidor se ha añadido correctamente', 'success');
                        window.location.reload();
                    },
                    error: function (xhr, status, error) {
                        Swal.fire('Error', 'No se pudo actualizar el servidor', 'error');
                        window.location.reload();
                    }
                });
            } else if (result.isDismissed) {
                // El usuario hizo clic en "Cancelar" y no es necesario realizar alguna acción.
            }
        });
    });
});
