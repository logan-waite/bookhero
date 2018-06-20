import UserApi from '../api/users.js';

export const user = {
  state: {
    id: null,
    name: '',
    email: '',
    attributes: [],
  },
  actions: {
    getUserInfo: function({ commit }) {
      return new Promise(( resolve, reject ) => {
        UserApi.getUser()
          .then( function( response ) {
            var user;
            if( _.isEmpty(response.data) ) {
              user = {};
            }
            else {
              // console.log(response.data);
              user = {
                'id' : response.data.id,
                'name' : response.data.name,
                'email' : response.data.email,
                'attributes' : response.data.attributes,
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
      state.id = user.id;
      state.name = user.name;
      state.email = user.email;
      state.attributes = user.attributes;
    }
  },
  getters: {
    getUserAttributes( state, getters, rootState ) {
      let all_attrs = rootState.attributes.attributes;
      if ( all_attrs.length > 0 ) {
        let attributes = [];

        for ( var a in state.attributes ) {
          let attr = state.attributes[a];

          let attr_info = all_attrs.find( x => x.id === attr.id );
          // console.log(attr_info);
          attributes.push({
            name: attr_info.name,
            level: attr.level,
            xp: attr.experience,
          });
        }

        return attributes;
      }
      return false;
    }
  }
}