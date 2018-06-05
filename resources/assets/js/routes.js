/*
|-------------------------------------------------------------------------------
| routes.js
|-------------------------------------------------------------------------------
| Contains all of the routes for the application
*/

/*
    Imports Vue and VueRouter to extend with the routes.
*/
import Vue from 'vue';
import VueRouter from 'vue-router';

/*
    Extends Vue to use Vue Router
*/
Vue.use( VueRouter );

/*
    Makes a new VueRouter that we will use to run all of the routes
    for the app.
*/
const router =  new VueRouter({
  routes: [
    {
      path: "/login",
      name: "login",
      component: Vue.component( "login", require( './pages/auth/login.vue' ) )
    },
    {
      path: "/register",
      name: "register",
      component: Vue.component( "register", require( './pages/auth/register.vue' ) )
    },
    {
      path: "/",
      name: "desktop",
      component: Vue.component( "desktop", require( './pages/layouts/desktop.vue' ) ),
      meta: { requiresAuth: true },
    }
  ]
});

export default router;
