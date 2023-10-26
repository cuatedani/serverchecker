import './bootstrap';

import Alpine from 'alpinejs';

import Swal from 'sweetalert2';
window.Swal = Swal;
import $ from 'jquery';
window.jQuery = $;
window.$ = $;

window.Alpine = Alpine;

Alpine.start();
