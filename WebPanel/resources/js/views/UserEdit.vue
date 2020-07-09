<template>
    <div id="content">
        <h1 class="content-title">Editing user {{displayUsername}}</h1>
        <hr />
        <div class="form-group">
            <label for="username">Username</label>
            <input
                v-model="user.username"
                type="text"
                class="form-control"
                name="username"
                id="username"
                placeholder="Username"
            />
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input
                v-model="user.email"
                type="text"
                class="form-control"
                name="email"
                id="email"
                placeholder="Email"
            />
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <div class="input-group">
                <input
                    v-model="user.password"
                    type="password"
                    class="form-control"
                    name="password"
                    id="password"
                    placeholder="Password"
                    disabled
                />
                <div class="input-group-append">
                    <button v-on:click="unlockPassword" class="btn btn-danger">
                        <i class="fas fa-lock"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="form-check-label" for="roleSelect">Roles</label>
            <multiselect
                id="roleSelect"
                v-model="user.roles"
                :options="roles"
                :multiple="true"
                label="name"
                track-by="name"
                :close-on-select="false"
                :clear-on-select="false"
                :preserve-search="true"
                placeholder="Edit the roles"
            ></multiselect>
        </div>
        <button v-on:click="sendEdit" class="btn btn-primary">Submit</button>
    </div>
</template>

<script>
import { FIND_USER, ROLE_NAMES } from "../graphql/queries";
import { UPDATE_USER } from "../graphql/mutations";

export default {
    name: "UserEdit",
    apollo: {
        user: {
            query: FIND_USER,
            variables() {
                return {
                    id: this.userId
                };
            },
            watchLoading(isLoading, countModifier){
                console.log(isLoading);
            }
        },
        roles: ROLE_NAMES
    },
    data: function() {
        return {
            userId: this.$route.params.userId,
            user: {
                username: "",
                roles: []
            },
            roles: [],
            displayUsername: null
        };
    },
    watch: {
        user(newValue, oldValue) {
            if (!this.displayUsername) this.displayUsername = newValue.username;
        }
    },
    methods: {
        prepareInput(user) {
            user.id = this.userId;
            let input = user;
            // Make an array of role IDs to use with the sync function
            input.roles = {
                sync: user.roles.map(role => role.id)
            };
            // Delete typename because gql has a problem with it
            // It doesn't belong in a query
            delete input.__typename;

            // Remove non-changed properties because of the unique rules in schema
            for (const [key1, value1] of Object.entries(input)) {
                for (const [key2, value2] of Object.entries(this.$options.initialUser)) {
                    if(key1 == key2 && value1 == value2){
                        console.log(value1, value2);
                        delete input[key1];
                    }
                }
            }

            return input;
        },
        /*
            SOLUTION FOR THIS FUCKING THING:
            make an input object that starts listening after the initial query load
            whenever a propery in the user object changes, it adds it to the input object
            lastly, just parse the role ids with the map function, voila!        
        */
        sendEdit: function() {
            let input = this.prepareInput(this.user);

            this.$apollo
                .mutate({
                    mutation: UPDATE_USER,
                    variables: {
                        input: input
                    }
                })
                .then(data => {
                    console.log(data.data);
                })
                .catch(({ graphQLErrors }) => {
                    console.log(graphQLErrors);
                });
        },
        unlockPassword: function() {
            $("#password").removeAttr("disabled");
        }
    }
};
</script>

<style scoped>
</style>
