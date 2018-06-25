<template>
  <div id='book-list'>
    <div class='currently-reading'>
      Currently Reading
      <book-tile
        v-if="currently_reading"
        :book="currently_reading"></book-tile>
    </div>
    <div class='upcoming'>
      Up Next
      <book-tile
        v-for="book in bookList"
        v-if="! book.currently_reading"
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
      currently_reading() {
        // console.log(this.$store.getters.currentlyReading)
        // return this.$store.state.books.books.find( function(b) {
        //   console.log(b.user_id !== null && b.currently_reading == true)
        //   return (b.user_id !== null && b.currently_reading == true);
        // });
        return this.$store.getters.currentlyReading;
      },
      bookList() {
        return this.$store.getters.bookList;
        // return this.$store.state.books.books.filter( b => b.user_id !== null);
      }
    },
    created() {
      // this.$store.dispatch( 'getBookList' );
    }
  }
</script>