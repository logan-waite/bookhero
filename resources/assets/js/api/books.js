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
  },
  updateBookList : function( type, action, book_id ) {
    var url = api_url + '/list/update';

    let data = {
      type,
      action,
      book_id,
    }

    return axios.put( url, data );
  },
  submitNewBook : function( book_info ) {
    var url = api_url + '/new';

    var data = {
      title: book_info.title,
      author: book_info.author,
      summary: book_info.summary,
      attributes: book_info.attributes,
    };

    console.log(data);

    return axios.put( url, data );
  }
}