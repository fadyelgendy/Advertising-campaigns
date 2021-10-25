require("./bootstrap");

import Vue from "vue";
import { library } from "@fortawesome/fontawesome-svg-core";
import {
    faPlusSquare,
    faPencilAlt,
    faSpinner,
    faEye,
    faArrowLeft,
    faSignOutAlt,
    faFlag
} from "@fortawesome/free-solid-svg-icons";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import router from "./router";
import store from "./store";
import App from "./App.vue";

// Font Awesome
library.add(
    faFlag,
    faSignOutAlt,
    faArrowLeft,
    faPlusSquare,
    faPencilAlt,
    faSpinner,
    faEye
);
Vue.component("font-awesome-icon", FontAwesomeIcon);

Vue.config.productionTip = false;

// Vue instance
new Vue({
    router,
    store,
    render: h => h(App)
}).$mount("#app");
