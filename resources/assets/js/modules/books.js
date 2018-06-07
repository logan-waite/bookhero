import BooksApi from '../api/books.js';

export const books = {
  state: {
    books: [],
    bookList: [],
    booksLoadingStatus: 0,
    bookListLoadingStatus: 0,
  },
  actions: {
    getAllBooks({ commit, rootState }) {
      commit( 'setBooksLoadingStatus', 1 );

      return new Promise(( resolve, reject ) => {
        BooksApi.getAllBooks()
          .then( function( response ) {
            commit( 'setBooks', response.data.books );
            commit( 'setBooksLoadingStatus', 2 );
            // get all the user's books
            let bookList = response.data.books.filter( b => b.user_id === rootState.users.user.id );
            commit( 'setBookList', bookList );

          })
          .catch( function( error ) {
            console.log( error )
            commit( 'setBooks', [] );
            commit( 'setBooksLoadingStatus', 3 );
            commit( 'setBookList', [] );
            reject();
          })
      })
    },
    getBookList({ commit }) {
      commit( 'setBookListLoadingStatus', 1 );

      return new Promise(( resolve, reject ) => {
        BooksApi.getBookList()
          .then( function( response ) {
            commit( 'setBookList', response.data.booklist );
            commit( 'setBookListLoadingStatus', 2 );
            resolve();
          })
          .catch( function( error ) {
            console.log( error );
            commit( 'setBookList', [] );
            commit( 'setBookListLoadingStatus', 3 );
            reject();
          });
      });
    },
   },
  mutations: {
    setBooksLoadingStatus( state, status ) {
      state.booksLoadingStatus = status;
    },
    setBookListLoadingStatus( state, status ) {
      state.bookListLoadingStatus = status;
    },
    setBooks( state, books ) {
      state.books = books;
    },
    setBookList( state, list ) {
      state.bookList = list;
    }
  },
  getters: {

  }
}

