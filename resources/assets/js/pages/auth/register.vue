<template>
  <div id="register" class="auth">
    <div class="wrapper">
      <div class="left">

      </div>
      <div class="right">
        <h1>Book Hero</h1>
        <h3>Show the world how awesome you are</h3>
        <form>
          <div>
            <input type="text" class="form-control" v-model="display_name" placeholder="Display Name" required>
          </div>
          <div>
            <input type="email" class="form-control" v-model="email" placeholder="Email" required>
          </div>
          <div>
            <input type="password" class="form-control" v-model="password" placeholder="Password" required>
          </div>
          <div>
            <button type="submit" @click.prevent="register" class="btn btn-primary">Login</button>
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
        display_name: "",
        email: "",
        password: "",
      };
    },
    methods: {
      register: function() {

      }
    }
  }
</script>