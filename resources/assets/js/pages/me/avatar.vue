<template>
  <div id='avatar'>
    <div class='prof-pic'>

    </div>
    <p class="name">
      {{ name }}
    </p>
    <ul class="attributes">
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