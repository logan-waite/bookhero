<template>
  <div id='avatar'>
    <div class='prof-pic'>

    </div>
    <p class="name">
      {{ name }}
    </p>
    <ul class="attributes">
      <li>Attribute 1</li>
      <li>Attribute 2</li>
      <li>Attribute 3</li>
      <li>Attribute 4</li>
      <li>Attribute 5</li>
    </ul>
  </div>
</template>

<script>
  export default {
    computed: {
      name() {
        return this.$store.getters.getUser.name;
      }
    }
  }
</script>