$(document).ready(function () {
    // Agrega un controlador de clic para los botones de eliminar
    $('.btn-delete').click(function (e) {
        e.preventDefault();
        const serverId = $(this).data('server-id'); // Obtiene el serverId del atributo de datos

        // Muestra el SweetAlert y utiliza el serverId en la confirmación
        Swal.fire({
            title: '¿Estás seguro de eliminar este servidor?',
            text: 'No podrás revertir esto',
            icon: 'warning',
            showCancelButton: true,
            cancelButtonText: 'Cancelar',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, elíminalo'
        }).then((result) => {
            if (result.isConfirmed) {
                // Realiza la eliminación AJAX
                $.ajax({
                    type: 'POST', // Utiliza el método DELETE
                    url: '/server/delete/' + serverId, // La URL de la ruta de eliminación
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Agrega el token CSRF
                    },
                    success: function (data) {
                        // Maneja la respuesta exitosa
                        console.log('El servidor se eliminó correctamente');
                        // Aquí puedes agregar más acciones, como actualizar la vista
                        window.location.reload();
                    },
                    error: function (xhr, status, error) {
                        // Maneja errores si es necesario
                        console.error('Error al eliminar el servidor');
                        window.location.reload();
                    }
                });
            }
        });
    });
});
