import Vue from 'vue';
import VueApollo from 'vue-apollo';
import ApolloClient, { HttpLink } from "apollo-boost";
import store from './store';

Vue.use(VueApollo);

const appLink = new HttpLink({ uri: window.location.origin + '/graphql' });

const apolloClient = new ApolloClient({
    // You should use an absolute URL here
    link: appLink,
    request: (operation) => {
        const token = store.state.auth.authenticated.token.access_token;
        operation.setContext({
            headers: {
                authorization: token ? `Bearer ${token}` : ''
            }
        });
    } 
});




const apolloProvider = new VueApollo({
    defaultClient: apolloClient,
});

export default apolloProvider;