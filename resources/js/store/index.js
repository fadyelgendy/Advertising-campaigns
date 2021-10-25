import Vuex from "vuex";
import creaePersistedState from "vuex-persistedstate";
import Vue from "vue";
import auth from "./modules/auth";
import compains from "./modules/compains";

// Load vuex
Vue.use(Vuex);

// Create Store
export default new Vuex.Store({
    plugins: [creaePersistedState()],
    modules: {
        auth,
        compains
    }
});
