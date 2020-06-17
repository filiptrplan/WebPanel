require('./bootstrap');

//Load Vue
import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter);

import App from './views/App.vue'
import UserList from './views/UserList'
import Login from './views/Login'

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/users',
            component: UserList,
        },
    ],
});

new Vue({
    router,
    render: h => h(App)
}).$mount('#app')
