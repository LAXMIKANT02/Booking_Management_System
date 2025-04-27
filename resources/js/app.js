import './bootstrap';
import jQuery from 'jquery';
import axios from 'axios';

window.$ = window.jQuery = jQuery;
window.axios = axios;

axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

const csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;

axios.defaults.headers.common['X-CSRF-TOKEN'] = csrfToken;

$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': csrfToken
        }
    });
});
