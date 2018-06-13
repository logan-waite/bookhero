import { API_URL } from '../config.js';

let api_url = API_URL + '/attributes';

export default {
  getAllAttributes: function() {
    var url = api_url + '/all';

    return axios.get( url );
  },
}