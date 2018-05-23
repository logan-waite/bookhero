/*
|-------------------------------------------------------------------------------
| VUEX store.js
|-------------------------------------------------------------------------------
| Builds the data store from all of the modules for Catalog
*/
/*
  Adds the promise polyfill for IE 11
*/
require('es6-promise').polyfill();

/*
    Imports Vue and Vuex
*/
import Vue from 'vue';
import Vuex from 'vuex';

/*
    Initializes Vuex on Vue.
*/
Vue.use( Vuex );

/*
    Imports all of the modules used in the application to build the data store.
*/
import { auth } from './modules/auth.js';

/*
  Exports our data store.
*/
export default new Vuex.Store({
  modules: {
    auth,
  }
});