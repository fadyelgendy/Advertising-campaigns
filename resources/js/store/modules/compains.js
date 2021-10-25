import axios from "axios";

const state = {
    compains: []
};
const getters = {
    allCompains: state => state.compains
};
const actions = {
    async fetchCompains({ commit }) {
        const response = await axios.get("/api/compain");
        commit("setCompains", response.data.compains);
    },
    async addCompain({ commit }, compain) {
        const response = await axios.post("/api/compain/store", compain);
        if (response.data.errors) {
            return response;
        }
        commit("newCompain", response.data.compain);
    },
    async updateCompain({ commit }, compain, id) {
        return await axios.put("/api/compain/update/", compain);
    }
};
const mutations = {
    setCompains: (state, compains) => (state.compains = compains),
    newCompain: (state, compain) => state.compains.unshift(compain)
};

export default {
    state,
    getters,
    actions,
    mutations
};
