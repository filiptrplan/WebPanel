import Vue from "vue";
import VueRouter from "vue-router";
import UserList from "./views/UserList";
import UserEdit from "./views/UserEdit";
import Login from "./views/Login";
import App from "./views/App.vue";

import store from './store';

Vue.use(VueRouter);

//TODO: before enter for authenticated

function isAuthenticated(to, from, next){
    if(store.state.auth.authenticated.isAuthenticated){
        next();
    } else {
        next('/login');
    }
}

function isNotAuthenticated(to, from, next){
    if(!store.state.auth.authenticated.isAuthenticated){
        next();
    } else {
        next('/users');
    }
}
    

export default new VueRouter({
    mode: "history",
    routes: [
        {
            path: "/",
            component: App,
            children: [
                {
                    path: "/users",
                    name: "users",
                    component: UserList
                },
                {
                    path: "/user/:userId/edit",
                    name: "user.edit",
                    component: UserEdit
                }
            ],
            beforeEnter: isAuthenticated
        },
        {
            path: "/login",
            name: "login",
            component: Login,
            beforeEnter: isNotAuthenticated
        }
    ]
});
