import Vuex from "vuex";
import Vue from "vue";
import compains from "./modules/compains";

// Load vuex
Vue.use(Vuex);

// Create Store
export default new Vuex.Store({
    modules: {
        compains
    }
});
