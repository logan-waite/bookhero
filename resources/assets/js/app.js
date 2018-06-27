window._ = require('lodash');
window.Popper = require('popper.js').default;

/**
* We'll load jQuery and the Bootstrap jQuery plugin which provides support
* for JavaScript based Bootstrap features such as modals and tabs. This
* code may be modified to fit the specific needs of your application.
*/

try {
  window.$ = window.jQuery = require('jquery');

  require('bootstrap');
} catch (e) {}

/**
* We'll load the axios HTTP library which allows us to easily issue requests
* to our Laravel back-end. This library automatically handles sending the
* CSRF token as a header based on the value of the "XSRF" token cookie.
*/

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
* Next we will register the CSRF Token as a common header with Axios so that
* all outgoing HTTP requests automatically have it attached. This is just
* a simple convenience so we don't have to attach every token manually.
*/

let csrf_token = document.head.querySelector('meta[name="csrf-token"]');

if (csrf_token) {
  window.axios.defaults.headers.common['X-CSRF-TOKEN'] = csrf_token.content;
} else {
  console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

// let id_token = localStorage.getItem('id_token');
//
// if( id_token ) {
//   window.axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('id_token');
// }

/**
* Next, we will create a fresh Vue application instance and attach it to
* the page. Then, you may begin adding components to this application
* or customize the JavaScript scaffolding to fit your unique needs.
*/

import Vue from 'vue';
import router from './routes.js';
import store from './store.js';

import { EventBus } from './event-bus.js';

router.beforeEach((to, from, next) => {
  if ( to.matched.some(record => record.meta.requiresAuth ) ) {
    setTimeout(function() { // Because otherwise we get redirected to login before actually getting the object
      if ( _.isEmpty(store.getters.getUser) ) {
        store.dispatch( 'getUserInfo' )
        .then( function( result ) {
          if ( _.isEmpty( result ) ) {
            next({
              path: '/login',
              query: { redirect: to.fullPath }
            });
          } else {
            next();
          }
        });
      } else {
        next();
      }
    }, 50);
  } else {
    next();
  }
});

new Vue({
  router,
  store,
  created() {
    // Set the loadCoreData event
    EventBus.$on( 'loadCoreData', function() {
      store.dispatch( 'getAllBooks' );
      store.dispatch( 'getAllAttributes' );
    });

    // Make sure the user is logged in.
    if ( _.isEmpty(store.getters.getUser) ) {
      // Check local storage to see if we've saved the token
      var token = localStorage.getItem("token");

      if ( token !== null ) {
        window.axios.defaults.headers.common["Authorization"] = "Bearer " + token;
        // this.$store.dispatch( 'refreshLogin', { user_id, token } )
        // .then(function() {
          store.dispatch( 'getUserInfo' );
          EventBus.$emit( 'loadCoreData' );
        // });
      }
    }
  }
}).$mount('#app');
