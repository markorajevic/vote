const cachios = require('cachios')
import apiConfig from '~/config/apiConfig.json'

const url = process.env.environment == 'development' ? apiConfig.devApi : apiConfig.prodApi;

var api = {
    getCountries: async () => {
        try {
            return await cachios.get(url + 'countries');
        } catch (error) {
            console.error(error)
        }
    },
    getResults: async () => {
        try {
            return await cachios.get(url + 'results');
        } catch (error) {
            console.error(error)
        }
    },
    getCountry: async (id) => {
        try {
            return await cachios.get(url + 'countries/' + id);
        } catch (error) {
            console.error(error)
        }
    },
    vote: async (data) => {
        try {
            return await cachios.post(url + 'vote', data);
        } catch (error) {
            console.error(error)
        }
    }
}
export default api;
