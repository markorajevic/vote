const cachios = require('cachios')
import api from '~/plugins/api'


const mutations = {
    SET_STATE: (state, { prop, value }) => {
        state[prop] = value
    },
    SET_VOTED: (state, { id }) => {
        console.log('id', id);
        // let countries = state['countries'];
        // _.each(countries, (country) => {
        //     if (country.id == id) {
        //         country.voted = 1;
        //     }
        // })
        console.log('countries', countries);
        commit('SET_STATE', { prop: 'countries', value: countries })

    }
};

const actions = {

    SET_STATE({ commit }, obj) {
        var value = Object.values(obj)[0];
        var prop = Object.keys(obj);
        commit('SET_STATE', { prop: prop, value: value })
    },
    SET_VOTED: ({ commit, getters }, { id }) => {
        let countries = getters.getCountries;
        _.each(countries, (country) => {
            console.log('cao', country.id, id);

            if (country.id == id) {
                country.voted = 1;
            }
        })
        commit('SET_STATE', { prop: 'countries', value: countries })

    },

    LOAD_COUNTRIES({ commit, dispatch }) {
        api.getCountries().then((countries) => {
            commit('SET_STATE', { prop: 'countries', value: countries.data })
        }).catch(console.error)
    },

    LOAD_RESULTS({ commit, dispatch }) {
        api.getResults().then((results) => {
            commit('SET_STATE', { prop: 'results', value: results.data })
        }).catch(console.error)
    },


};


const getters = {

    getCountries: state => {
        return state.countries
    },
    getResults: state => {
        return state.results
    },

    getPages: state => {
        return state.pages
    }
};

const state = {
    countries: [],
    results: []

};

export default {
    namespaced: true,
    actions,
    getters,
    state,
    mutations
};
