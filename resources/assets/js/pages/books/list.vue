<template>
  <div id='book-list'>
    <div class='currently-reading'>
      Currently Reading
      <!-- <book-tile></book-tile> -->
    </div>
    <div class='upcoming'>
      Up Next
      <!-- <book-tile></book-tile> -->
    </div>
  </div>
</template>

<script>
  import BookTile from '../../components/BookTile.vue';

  export default {
    components: {
      BookTile,
    }
  }
</script>