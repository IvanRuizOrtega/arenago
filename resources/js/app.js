import axios from "axios";

window.axios = axios;
window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";
window.axios.defaults.withCredentials = true; // Envía laravel-session automáticamente
window.axios.defaults.headers.common["Accept"] = "application/json"; // Fuerza respuestas JSON en errores

const token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common["X-CSRF-TOKEN"] = token.content;
} else {
    console.log("failed get token");
}

import Alpine from "alpinejs";
// Lo exponemos globalmente ANTES de arrancarlo
window.Alpine = Alpine;
