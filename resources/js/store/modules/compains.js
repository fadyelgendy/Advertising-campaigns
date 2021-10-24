import axios from "axios";

const state = {
    compains: []
};
const getters = {
    allCompains: state => state.compains
};
const actions = {
    async fetchCompains({ commit }) {
        const response = await axios("/api/compain");

        commit("setCompains", response.data.compains.data);
    }
};
const mutations = {
    setCompains: (state, compains) => (state.compains = compains)
};

export default {
    state,
    getters,
    actions,
    mutations
};
