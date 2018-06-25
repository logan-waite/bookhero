<template>
  <div id="desktop">
    <navigation></navigation>

    <div class="row">
      <div class='col left'>
        <avatar></avatar>
      </div>
      <div class='col-5 center'>
        <!-- <discover></discover> -->
        <router-view></router-view>
      </div>
      <div class='col-4 right'>
        <book-list></book-list>
      </div>
    </div>
  </div>
</template>

<script>
  import Navigation from '../../components/Navigation.vue'
  import BookList from '../books/list.vue';
  // import Discover from '../books/discover.vue';
  import Avatar from '../me/avatar.vue';

  export default {
    components: {
      Navigation,
      BookList,
      // Discover,
      Avatar,
    }
  }
</script>