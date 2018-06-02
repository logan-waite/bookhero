<template>
  <div id="home" class="row">
    <div class='col left'>
      <avatar></avatar>
    </div>
    <div class='col-5 center'>
      <discover></discover>
    </div>
    <div class='col-4 right'>
      <book-list></book-list>
    </div>

  </div>
</template>

<script>
  import BookList from './books/list.vue';
  import Discover from './books/discover.vue';
  import Avatar from './me/avatar.vue';

  export default {
    components: {
      BookList,
      Discover,
      Avatar,
    }
  }
</script>