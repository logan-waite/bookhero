<template>
  <div id='discover'>
    <book-tile
      v-for="book in books"
      v-if="book.user_id === null"
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
      this.$store.dispatch( 'getAllAttributes' );
    }
  }
</script>