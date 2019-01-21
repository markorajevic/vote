import Vue from 'vue'
import Vuex from 'vuex'

import app from './modules/app';
import country from './modules/country';


Vue.use(Vuex)


export default () => {
    return new Vuex.Store({
        actions: {
            async nuxtServerInit({ dispatch, commit, state }, { req }) {
                dispatch('countries/LOAD_COUNTRIES')
                dispatch('country/LOAD_RESULTS');
            },
        },
        modules: {
            app,
            country
        }
    })
}