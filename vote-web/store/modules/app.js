
const mutations = {
    SET_STATE: (state, { prop, value }) => {
        state[prop] = value
    },
};

const actions = {
    SET_STATE({ commit }, obj) {
        for (var key in obj) {
            if (obj.hasOwnProperty(key)) {
                commit('SET_STATE', { prop: key, value: obj[key] })
            }
        }
    }
};

const getters = {
    getState: state => prop => {
        return state[prop]
    }
};

const state = {
};

export default {
    namespaced: true,
    actions,
    getters,
    state,
    mutations,
};
