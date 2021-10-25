import Compains from "../components/Compains";
import Login from "../components/Login.vue";
import Register from "../components/Register.vue";
import AddCompain from "../components/AddCompain.vue";
import Compain from "../components/Compain.vue";

const routes = [
    {
        name: "home",
        path: "/compains",
        component: Compains,
        meta: { requireAuth: true }
    },
    {
        name: "create.compain",
        path: "/compain/create",
        component: AddCompain,
        meta: { requireAuth: true }
    },
    {
        name: "edit.compain",
        path: "/compain/edit/:id",
        component: Compain,
        meta: { requireAuth: true }
    },
    {
        name: "logout",
        path: "/logout",
        meta: { requireAuth: true }
    },
    {
        name: "login",
        path: "/login",
        component: Login,
        meta: { requireAuth: false }
    },
    {
        name: "register",
        path: "/register",
        component: Register,
        meta: { requireAuth: false }
    }
];

export default routes;
