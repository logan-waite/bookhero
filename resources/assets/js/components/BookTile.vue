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
  </div>
</template>

<script>
  export default {
    props: [ 'book' ],

  }
</script>