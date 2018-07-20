<template>
  <div id='avatar'>
    <div class='prof-pic'>
      <img src="/img/stick_hero.jpg">
    </div>
    <p class="name">
      {{ name }}
    </p>
    <p v-if="attributes.length === 0"> Read some books to grow your abilities!</p>
    <ul class="attributes" v-else>
      <li v-for="attr in attributes">{{ attr.name }} - {{ attr.level }}</li>
    </ul>
  </div>
</template>

<script>
  export default {
    computed: {
      name() {
        return this.$store.state.user.name;
      },
      attributes() {
        return this.$store.getters.getUserAttributes;
      }
    }
  }
</script>