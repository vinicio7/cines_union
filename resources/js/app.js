

require('./bootstrap');
import DataTable from 'laravel-vue-datatable';
window.Vue = require('vue');
Vue.component('cinema-component', require('./components/CinemaComponent.vue').default);
Vue.component('cinemaroom-component', require('./components/CinemaRoomComponent.vue').default);
Vue.component('seats-component', require('./components/SeatComponent.vue').default);
Vue.component('users-component', require('./components/UserComponent.vue').default);
Vue.use(DataTable);

const app = new Vue({
    el: '#app',
});


