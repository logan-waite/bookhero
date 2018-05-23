<template>
  <div id="login" class="auth">
    <div class="wrapper">
      <div class="left">

      </div>
      <div class="right">
        <h1>Book Hero</h1>
        <h3>Show the world how awesome you are</h3>
        <form>
          <div>
            <input type="email" class="form-control" v-model="email" placeholder="Email" required>
          </div>
          <div>
            <input type="password" class="form-control" v-model="password" placeholder="Password" required>
          </div>
          <div>
            <button type="submit" @click.prevent="login" class="btn btn-primary">Login</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data: function() {
    return {
      email: "",
      password: ""
    }
  },
  methods: {
    login: function() {
      this.$store.dispatch('login', { email: this.email, password: this.password })
    }
  }
}
</script>