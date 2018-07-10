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
    token: null,
  },
  actions: {
    login: function({ commit }, info) {
      return new Promise((resolve, reject) => {
        AuthAPI.login(info.email, info.password)
        .then( function( response ) {
          console.log(response)
          localStorage.setItem( "token", response.data.access_token );
          window.axios.defaults.headers.common["Authorization"] = "Bearer " + response.data.access_token;
          commit('setToken', response.data.access_token);
          resolve();
        })
        .catch( function( error ) {
          reject( error );
        })
      });
    },
    register: function({ commit }, info) {
      return new Promise(( resolve, reject ) => {
        AuthAPI.register(info.display_name, info.email, info.password)
        .then( function(response) {
          resolve();
        })
        .catch( function( error ) {
          reject( error );
        })
      })
    }
  },
  mutations: {
    setUser: function( state, user ) {
      state.user = user;
    },
    setToken: function( state, token ) {
      state.token = token;
    }
  },
  getters: {

  }
}