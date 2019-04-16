
/*
require('./bootstrap');

window.Vue = require('vue');

import VueRouter from 'vue-router';
Vue.use(VueRouter);

import VueAxios from 'vue-axios';
import axios from 'axios';
Vue.use(VueAxios, axios);

Vue.component('example-component', require('./components/ExampleComponent.vue'));

const router = new VueRouter({ mode: 'history'});
const app = new Vue(Vue.util.extend({ router })).$mount('#app');*/

// app.js



require('./bootstrap');

// window.Vue = require('vue');
import Vue from 'vue'
import Rutas from './rutas.js';

import VueRouter from 'vue-router';
Vue.use(VueRouter);

import axios from 'axios';
import VueAxios from 'vue-axios';

import App from './App.vue';
Vue.use(VueAxios, axios);

import VueMaterial from 'vue-material'

import 'vue-material/dist/vue-material.min.css'

import VueAuth from '@websanova/vue-auth'

Vue.use(VueMaterial)

import Notifications from 'vue-notification'

Vue.use(Notifications)

import zloading from 'z-loading';
import 'z-loading/dist/z-loading.css';

Vue.use(zloading);

Vue.use(require('@hscmap/vue-window'))

import VModal from 'vue-js-modal'

Vue.use(VModal)



 import datePicker from 'vue-bootstrap-datetimepicker';
  import 'bootstrap/dist/css/bootstrap.css';
  import 'pc-bootstrap4-datetimepicker/build/css/bootstrap-datetimepicker.css';
  Vue.use(datePicker);
  import VueChatScroll from 'vue-chat-scroll'
  Vue.use(VueChatScroll)



const router = new VueRouter({ /*mode: 'history',*/ routes: Rutas});
Vue.router = router;

App.router = Vue.router;



Vue.use(require('@websanova/vue-auth'), {
   auth: require('@websanova/vue-auth/drivers/auth/bearer.js'),
   http: require('@websanova/vue-auth/drivers/http/axios.1.x.js'),
   router: require('@websanova/vue-auth/drivers/router/vue-router.2.x.js'),
   rolesVar: 'rol_id',
   loginData: {url: ' api/auth/login'},
   logoutData: {url: ' api/auth/logout'},
   fetchData: {url: ' api/auth/user'},
   refreshData: {enabled: false},
});

// Vue.component('chat-messages', require('./components/authdocente/modulo/mensajeria/ChatMessages.vue'));
Vue.component('chat-form', require('./components/authdocente/modulo/mensajeria/ChatForm.vue'));
new Vue(App).$mount('#app');
// const app = new Vue(Vue.util.extend({ router }, App)).$mount('#app');



// require('./bootstrap');
// import Vue from 'vue'
// import VueRouter from 'vue-router'
// import routes from './rutas';


// //Axios
// import axios from 'axios'
// import VueAxios from 'vue-axios'
// //jwt
// import VueAuth from '@websanova/vue-auth'


// Vue.use(VueRouter)

// Vue.router = new VueRouter({
//   routes: [
//     ...routes,

//   ],
//   //mode: 'history'
// });
// let AppLayout= require('./components/ExampleComponent.vue');//Vista Suprema

 
// Vue.use(VueAxios, axios)
// // Vue.use(Element);
// // Vue.use(esLocale)


// Vue.use(VueAuth, {
//    auth: require('@websanova/vue-auth/drivers/auth/bearer.js'),
//    http: require('@websanova/vue-auth/drivers/http/axios.1.x.js'),
//    router: require('@websanova/vue-auth/drivers/router/vue-router.2.x.js'),
//    rolesVar: 'type',
//    loginData: {url: ' api/auth/login'},
//    logoutData: {url: ' api/auth/logout'},
//    fetchData: {url: ' api/auth/user'},
//    refreshData: {enabled: false},
// });

// //const router = new VueRouter({ mode: 'history', routes: routes})


// AppLayout.router = Vue.router;

// new Vue(AppLayout).$mount('#app');