import { API_URL } from '../config.js';

export default {
  login : function(email, password) {
    var url = API_URL + '/login';

    return axios.post( url, { "email" : email, "password" : password } );
  },
  register : function( name, email, password ) {
    var url = API_URL + '/register';

    var data = {
      name: name,
      email,
      password,
    }

    return axios.post( url, data );
  }
}