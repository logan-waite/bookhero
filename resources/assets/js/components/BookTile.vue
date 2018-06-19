<template>
  <div class='book-tile'>
    <div class='cover'>

    </div>
    <div class='info'>
      <p class='title'>
        {{ book.title }}
      </p>
      <p class='author'>
        {{ book.author.name }}
      </p>
    </div>
    <div class='actions'>
      <i v-show="! book.currently_reading" @click="setCurrentlyReading(true)" class='far fa-book'></i>
      <i v-show="book.currently_reading" @click="finishBook()" class='far fa-book-open'></i>
      <i v-show="book.user_id === null" class='far fa-plus' @click="addBookToList()"></i>
      <i v-show="book.user_id !== null && ! book.currently_reading" class='far fa-times' @click="removeBookFromList()"></i>
      <i v-show="book.currently_reading" class='far fa-minus' @click="setCurrentlyReading(false)"></i>
    </div>
  </div>
</template>

<script>
  export default {
    props: [ 'book' ],
    methods: {
      addBookToList() {
        this.$store.dispatch( 'updateBookList', { type:"add", book_id: this.book.id, action: null } );
      },
      removeBookFromList() {
        this.$store.dispatch( 'updateBookList', { type:"remove", book_id: this.book.id, action: null } );
      },
      setCurrentlyReading( action ) {
        if ( action ) {
          if( this.$store.getters.currentlyReading ) {
            let replace = confirm("You are already reading a book! Do you want to replace your current book?");
            if ( ! replace ) {
              return false;
            }
          }
        }
        this.$store.dispatch( 'updateBookList', { type:"currently_reading", book_id: this.book.id, action } );
      },
      finishBook() {
        this.$store.dispatch( 'updateBookList', { type: 'finished', book_id: this.book.id, action: true });
      }
    }
  }
</script>