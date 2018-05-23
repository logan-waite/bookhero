import { API_URL } from '../config.js';

export default {
  login : function(email, password) {
    var url = API_URL + '/login';

    return axios.post( url, { "email" : email, "password" : password } );
  },
}