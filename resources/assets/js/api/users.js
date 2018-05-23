import { API_URL } from '../config.js';

export default {
  getUser : function() {
    var url = API_URL + '/user';

    return axios.get( url );
  },
}