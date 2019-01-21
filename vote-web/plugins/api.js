const cachios = require('cachios')


var api = {
    getCountries: async () => {
        try {
            return await cachios.get('http://localhost:8000/countries');
        } catch (error) {
            console.error(error)
        }
    },
    getResults: async () => {
        try {
            return await cachios.get('http://localhost:8000/results');
        } catch (error) {
            console.error(error)
        }
    },
    getCountry: async (id) => {
        try {
            return await cachios.get('http://localhost:8000/countries/' + id);
        } catch (error) {
            console.error(error)
        }
    },
    vote: async (data) => {
        try {
            return await cachios.post('http://localhost:8000/vote/', data);
        } catch (error) {
            console.error(error)
        }
    }
}
export default api;
