import UserAPI from '../api/users.js';

export const users = {
  state: {
    user: null
  },
  actions: {
    getUserInfo: function({ commit }) {
      return new Promise(( resolve, reject ) => {
        UserAPI.getUser()
          .then( function( response ) {
            var user;
            if( _.isEmpty(response.data) ) {
              user = {};
            }
            else {
              user = {
                'id' : response.data.id,
                'name' : response.data.name,
                'email' : response.data.email,
              };
            }
            commit( 'setUserInfo', user );
            resolve( user );
          })
          .catch( function( error ) {
            console.log( error );
            reject();
          });
      })
    }
  },
  mutations: {
    setUserInfo: function( state, user ) {
      state.user = user;
    }
  },
  getters: {
    getUser: function( state ) {
      return state.user;
    }
  }
}