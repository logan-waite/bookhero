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
            // let bookList = response.data.books.filter( b => b.user_id === rootState.users.user.id );
            // commit( 'setBookList', bookList );

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
    addBookToList({ commit, rootState }, book_id) {
      return new Promise(( resolve, reject ) => {
        BooksApi.addBookToList(book_id)
          .then( function( response ) {
            commit('addBookToList', { user_id: rootState.users.user.id, book_id });
            resolve();
          })
          .catch( function( error ) {
            console.log( error );
            reject();
          });
      })
    },
    updateBookList({ commit, rootState }, info) {
      let book_id = info.book_id;
      let type = info.type;
      let action = info.action;

      return new Promise(( resolve, reject ) => {
        BooksApi.updateBookList(type, action, book_id)
          .then( function( response ) {
            console.log(response);
            switch ( type ) {
              case "add":
                commit('addBookToList', { user_id: rootState.users.user.id, book_id });
                break;
              case "remove":
                commit('removeBookFromList', { user_id: rootState.users.user.id, book_id });
                break;
              case "currently_reading":
                if ( action === true ) {
                  commit('addBookToList', { user_id: rootState.users.user.id, book_id });
                }
                commit('setReadingStatus', { book_id, action });
                break;
              case "finished":
                commit('setFinishedStatus', { book_id, action });
                break;
            }

          })
      })
    }
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
    },
    addBookToList( state, info ) {
      state.books.find( b => b.id === info.book_id).user_id = info.user_id;
    },
    removeBookFromList( state, info ) {
      let book = state.books.find( b => b.id === info.book_id);
      book.user_id = null;
      book.currently_reading = false;
    },
    setReadingStatus( state, info ) {
      let book = state.books.find( b => b.user_id !== null && b.currently_reading == true);
      if ( book !== undefined && info.action === true ) {
        book.currently_reading = false;
      }
      state.books.find( b => b.id === info.book_id).currently_reading = info.action;
    },
    setFinishedStatus( state, info ) {
      console.log("hello?");
      let book = state.books.find( b => b.id === info.book_id);
      book.finished = info.action;
      if ( info.action === true ) {
        book.currently_reading = false;
      }
    }
  },
  getters: {
    bookList( state ) {
      return state.books.filter( b => b.user_id !== null && b.currently_reading == false);
    },
    currentlyReading( state ) {
      return state.books.find( b => b.user_id !== null && b.currently_reading == true);
    }
  }
}

