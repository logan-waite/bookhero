/*
|-------------------------------------------------------------------------------
| VUEX modules/auth.js
|-------------------------------------------------------------------------------
| The Vuex data store for user auth info
*/

/* Load states are as follows:
| 0 -> No loading has begun
| 1 -> Loading has started
| 2 -> Loading has completed successfully
| 3 -> Loading has completed unsuccessfully.
*/

import AuthAPI from '../api/auth.js';

export const auth = {
  state: {
    user: null,
    userToken: null,
  },
  actions: {
    login: function({ commit }, info) {
      return new Promise((resolve, reject) => {
        AuthAPI.login(info.email, info.password)
        .then( function( response ) {
          console.log(response)
          // localStorage.setItem( "token", response.data.api_token.token );
          // localStorage.setItem( 'user_id', response.data.id );
          // window.axios.defaults.headers.common["Authorization"] = "Bearer " + response.data.api_token.token;
          // commit( 'setUser', response.data );
          resolve();
        })
        .catch( function( error ) {
          commit( 'setUser', {} );
          reject( error );
        })
      });
    }
  },
  mutations: {
    setUser: function( state, user ) {
      state.user = user;
    }
  },
  getters: {

  }
}