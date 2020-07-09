import Vue from 'vue';
import Vuex from 'vuex';
import VuexPersistence from 'vuex-persist';
import { createStore } from 'vuex-extensions'; 

import AuthModule from './store_modules/auth';


Vue.use(Vuex);

const vuexLocal = new VuexPersistence({
    storage: window.localStorage
});


const store = createStore(Vuex.Store, {
    modules: {
        auth: AuthModule
    },
    plugins: [vuexLocal.plugin]
});

export default store;