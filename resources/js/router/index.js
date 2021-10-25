import Vue from "vue";
import Router from "vue-router";
import store from "../store";
import routes from "./routes";

Vue.use(Router);

const router = new Router({
    mode: "history",
    routes
});

router.beforeEach((to, from, next) => {
    if (to.meta.requireAuth && !store.state.auth.authenticated)
        next({ name: "login" });
    else next();
});

export default router;
