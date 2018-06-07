import { API_URL } from '../config.js';

let api_url = API_URL + '/books';

export default {
  getAllBooks : function() {
    var url = api_url + '/all';

    return axios.get( url );
  },
  getBookList : function() {
    var url = api_url + '/list';

    return axios.get( url );
  },
  addBookToList : function( book_id ) {
    var url = api_url + '/list/add';

    return axios.put( url, { book_id } );
  }
}