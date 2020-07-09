import only from "only";

import { LOGIN_USER, LOGOUT_USER } from "../graphql/mutations";

const state = {
    authenticated: {
        token: {
            access_token: "",
            refresh_token: "",
            expires_in: 0,
            token_type: ""
        },
        user: {
            username: "",
            email: "",
            id: 0
        },
        isAuthenticated: false
    }
};

const mutations = {
    SET_TOKEN(state, token) {
        state.authenticated.token = token;
    },
    SET_USER(state, user) {
        state.authenticated.user = user;
    },
    SET_AUTHENTICATED(state, value) {
        state.authenticated.isAuthenticated = value;
    },
    CLEAR_AUTHENTICATED() {
        this.reset();
    }
};

const actions = {
    login({ commit }, input) {
        return new Promise((resolve, reject) => {
            this.$app.$apollo
                .mutate({
                    mutation: LOGIN_USER,
                    variables: {
                        input: input
                    }
                })
                .then(data => {
                    const { user, ...token } = data.data.login;
                    commit(
                        "SET_TOKEN",
                        only(
                            token,
                            "access_token refresh_token expires_in token_type"
                        )
                    );
                    commit("SET_USER", only(user, "username email id"));
                    commit("SET_AUTHENTICATED", true);
                    resolve();
                })
                .catch(({ graphQLErrors }) => {
                    reject(graphQLErrors);
                });
        });
    },
    logout({ commit }) {
        return new Promise((resolve, reject) => {

            this.$app.$apollo.mutate({
                mutation: LOGOUT_USER
            })
            .then(() => {
                commit('CLEAR_AUTHENTICATED');
                resolve()
            })
            .catch(({graphQLErrors}) => {
                reject(graphQLErrors);
            });
        });        
    }
};


export default {
    namespaced: true,
    actions,
    mutations,
    state
}