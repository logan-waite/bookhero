import { API_URL } from '../config.js';

let api_url = API_URL + '/books';

export default {
  getAllBooks : function() {
    var url = api_url + '/all';

    return axios.get( url );
  },
}