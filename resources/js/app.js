require('./bootstrap');
import {createApp} from "vue";
import App from "./chat/App.vue"
import toastr from './chat/helpers/toastr'
import router from "./chat/router"
import Toast from 'vue-toastification'
import store from './chat/store'

window.toast = toastr

const options = {
    transition: "my-custom-fade",
    timeout: 3000,
    maxToasts: 20,
    newestOnTop: true
};

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

createApp(App)
    .use(store)
    .use(router)
    .use(Toast, options)
    .mount("#app")
