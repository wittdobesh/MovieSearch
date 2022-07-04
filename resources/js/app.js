import './bootstrap';

import {createApp} from 'vue';

import App from './vue/app.vue';

const app = createApp({
    el: '#app',
    components: { App }
});
app.mount("#app");