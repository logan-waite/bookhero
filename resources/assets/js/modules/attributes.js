import AttributesApi from '../api/attributes.js';

export const attributes = {
  state: {
    attributes: [],
    attributeLoadStatus: 0,
  },
  actions: {
    getAllAttributes({ commit }) {
      commit('setAttributeLoadStatus', 1);

      return new Promise(( resolve, reject ) => {
        AttributesApi.getAllAttributes()
          .then( function( response ) {
            commit( 'setAttributes', response.data.attributes );
            commit( 'setAttributeLoadStatus', 2)
          })
          .catch( function( error ) {
            console.log( error );
            commit( 'setAttributes', [] );
            commit( 'setAttributeLoadStatus', 3 );
          })
      })
    }
  },
  mutations: {
    setAttributeLoadStatus( state, status ) {
      state.attributeLoadStatus = status;
    },
    setAttributes( state, attributes ) {
      state.attributes = attributes;
    },

  },
  getters: {

  }
}