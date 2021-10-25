import axios from "axios";
import router from "../../router/index";

const state = {
    authenticated: false,
    user: {}
};
const getters = {
    authenticated(state) {
        return state.authenticated;
    },
    user(state) {
        return state.user;
    }
};
const actions = {
    async login({ commit }, auth) {
        return await axios
            .post("/api/login", auth)
            .then(data => {
                if (data.data.errors) {
                    return alert(data.data.errors);
                } else {
                    commit("setUser", data.data.user);
                    commit("setAuthenticated", true);
                    router.push({ name: "home" });
                }
            })
            .catch(({ response: { data } }) => {
                commit("setUser", {});
                commit("setAuthenticated", false);
            });
    },
    logout({ commit }) {
        commit("setUser", {});
        commit("setAuthenticated", false);
    }
};

const mutations = {
    setAuthenticated: (state, value) => (state.authenticated = value),
    setUser: (state, value) => (state.user = value)
};

export default {
    state,
    getters,
    actions,
    mutations
};
