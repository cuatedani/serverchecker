$(document).ready(function () {
    $('.btn-outline-info').click(function () {
        // Encuentra el elemento hijo i dentro del botón
        var icon = $(this).find('i');

        // Alternar entre bi-eye-slash y bi-eye
        if (icon.hasClass('bi-eye-slash')) {
            icon.removeClass('bi-eye-slash').addClass('bi-eye');
        } else {
            icon.removeClass('bi-eye').addClass('bi-eye-slash');
        }
    });
});