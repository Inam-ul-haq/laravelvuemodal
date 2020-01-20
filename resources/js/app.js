require('./bootstrap');

 window.Vue = require('vue');

import VueRouter from 'vue-router';
import moment from 'moment';
import VueProgressBar from 'vue-progressbar'
import Swal from 'sweetalert2'
window.Swal =  Swal;


const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,
  onOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
});
window.Toast = Toast;
Vue.use(VueRouter)

window.Form =new Form;
import { Form, HasError, AlertError } from 'vform';

Vue.component(HasError.name, HasError);
Vue.component(AlertError.name, AlertError);
import VueAxios from 'vue-axios';
import axios from 'axios';
Vue.use(VueAxios, axios);



// import Dashboard from './components/Dashboard.vue';
// import Profile from './components/Profile.vue';
import DashboardComponent from './components/DashboardComponent.vue';
import PostComponent from './components/PostComponent.vue';


const routes = [
    {
        name: 'dashboard',
        path: '/dashboard',
        component: DashboardComponent
    },
    {
        name: 'post',
        path: '/post',
        component: PostComponent
    }
];


const router = new VueRouter({
  mode: 'history',
  routes // short for `routes: routes`
})

window.Fire = new Vue();

Vue.filter('uppertext',function(text){
 return text.charAt(0).toUpperCase() + text.slice(1)
});
Vue.filter('date',function(created){
	return moment().format('MMMM Do YYYY');
});


Vue.use(VueProgressBar, {
  color: 'rgb(143, 255, 199)',
  failedColor: 'red',
  height: '2px'
})

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
     router
});
