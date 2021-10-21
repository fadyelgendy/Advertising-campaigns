require('./bootstrap');

import Vue from 'vue';
import App from "./components/App.vue";

// Vue instance
const app = new Vue({
    el: "#app",
    components: {
        App
    }
});
