<template>
  <div id='book-list'>
    <div class='currently-reading'>
      Currently Reading
      <!-- <book-tile></book-tile> -->
    </div>
    <div class='upcoming'>
      Up Next
      <book-tile
        v-for="book in bookList"
        :book="book"
        :key="book.id"></book-tile>
    </div>
  </div>
</template>

<script>
  import BookTile from '../../components/BookTile.vue';

  export default {
    components: {
      BookTile,
    },
    computed: {
      bookList() {
        return this.$store.state.books.bookList;
      }
    },
    created() {
      // this.$store.dispatch( 'getBookList' );
    }
  }
</script>