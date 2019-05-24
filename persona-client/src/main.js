

import Vue from 'vue'
import VueRouter from 'vue-router'



Vue.use(VueRouter);

import Dashboard from './components/Dashboard.vue';
import PersonList from './components/PersonList.vue';


const routes = [
  { path: '/', component: Dashboard },
  { path: '/listado', component: PersonList },

];

const router = new VueRouter({
  mode: 'history',
  routes
});

new Vue({
  router,
  render: h => h(Dashboard),
}).$mount('#app');

Vue.filter('formatDate', function (value)
{
    if (value)
    {
      var date = new Date(value);
      return date.toLocaleDateString('es', {year:"2-digit", month:"2-digit", day:"2-digit"});
    }
})
