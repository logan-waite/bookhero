<template>
  <div id='discover'>
    <p v-if="books.length === 0">No books? Head over to the contribute tab and add some books to read.</p>
    <book-tile
      v-for="book in books"
      v-if="! book.finished && book.user_id === null"
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

    }
  }
</script>