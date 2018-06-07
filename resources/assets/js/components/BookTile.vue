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
      <i class='far fa-book'></i>
      <i class='far fa-book-open'></i>
      <i v-show="! book.active" class='far fa-plus'></i>
      <i v-show="book.active" class='far fa-times'></i>
    </div>
  </div>
</template>

<script>
  export default {
    props: [ 'book' ],
  }
</script>