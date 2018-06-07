<template>
  <div id='discover'>
    <book-tile
      v-for="book in books"
      :book="book"
      :key="book.id"></book-tile>
  </div>
</template>

<script>
  import BookTile from '../../components/BookTile.vue';

  export default {
    components: {
      BookTile,
    },
    computed: {
      books() {        
        return this.$store.state.books.books;
      }
    },
    created() {
      this.$store.dispatch( 'getAllBooks' );
    }
  }
</script>