<template>
  <nav id="navigation">
    <router-link :to="{ name: 'discover' }" class='btn btn-outline-primary'><i class='fal fa-binoculars'></i> Discover</router-link>
    <router-link :to="{ name: 'contribute' }" class='btn btn-outline-primary'><i class='fal fa-book'></i> Contribute</router-link>

  </nav>
</template>