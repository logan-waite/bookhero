<template>
  <nav id="navigation">
    <router-link :to="{ name: 'discover' }" class='btn btn-outline-primary'><i class='fal fa-binoculars'></i> Discover</router-link>
    <router-link :to="{ name: 'contribute' }" class='btn btn-outline-primary'><i class='fal fa-book'></i> Contribute</router-link>
    <router-link :to="{ name: 'avatar' }" class='btn btn-outline-primary d-md-none'><i class='fal fa-user-astronaut'></i> Me</router-link>
    <router-link :to="{ name: 'book-list' }" class='btn btn-outline-primary d-md-none'><i class='fal fa-list'></i> Book List</router-link>
  </nav>
</template>

<script>
  export default {

  }
</script>