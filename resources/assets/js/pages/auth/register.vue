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
        var self = this;
        var data = {
          display_name: this.display_name,
          email: this.email,
          password: this.password,
        }

        this.$store.dispatch( 'register', data )
        .then(function() {
          self.$store.dispatch( 'login', { email: data.email, password: data.password })
          .then( function() {
            self.$router.push({ name: 'discover' });
          })
        })
        .catch( function(error) {
          console.log(error);
        });
      }
    }
  }
</script>