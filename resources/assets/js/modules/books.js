import BooksApi from '../api/books.js';

export const books = {
  state: {
    books: [],
    booksLoadingStatus: 0,
  },
  actions: {
    getAllBooks({ commit }) {
      commit( 'setBooksLoadingStatus', 1 );

      return new Promise(( resolve, reject ) => {
        BooksApi.getAllBooks()
          .then( function( response ) {
            console.log(response.data.books);
            commit( 'setBooks', response.data.books );
            commit( 'setBooksLoadingStatus', 2 );
          })
          .catch( function( error ) {
            console.log( error )
            commit( 'setBooks', [] );
            commit( 'setBooksLoadingStatus', 3 );
            reject();
          })
      })
    }
  },
  mutations: {
    setBooksLoadingStatus( state, status ) {
      state.booksLoadingStatus = status;
    },
    setBooks( state, books ) {
      state.books = books;
    }
  },
  getters: {

  }
}

