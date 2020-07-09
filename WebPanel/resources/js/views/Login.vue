<template>
    <div class="container-fluid row" style="height: 100vh;">
        <div class="col-md-3"></div>
        <div id="login-card" class="card align-middle col-md-6">
            <div class="card-body">
                <h5 class="card-title">Login</h5>
                <form @submit.prevent="login">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input
                            required
                            v-model="username"
                            type="text"
                            class="form-control"
                            placeholder="Username"
                        />
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input
                            required
                            v-model="password"
                            type="password"
                            class="form-control"
                            placeholder="Password"
                        />
                    </div>

                    <button v-if="!isLoading" type="submit" class="btn btn-primary">Submit</button>
                    <button v-else disabled type="submit" class="btn btn-primary">Loading...</button>
                </form>
                <error-alert :graphQLerror="gqlError" class="mt-2"></error-alert>
            </div>
        </div>
        <div class="col-md-3"></div>
    </div>
</template>

<script>
import { mapActions } from "vuex";

export default {
    name: "Login",
    data: function() {
        return {
            username: "",
            password: "",
            isLoading: false,
            gqlError: null
        };
    },
    methods: {
        ...mapActions({
            storeLogin: "auth/login"
        }),
        login: function() {
            if (!this.isLoading) {
                this.isLoading = true;
                let input = {
                    username: this.username,
                    password: this.password
                };
                this.storeLogin(input)
                    .then(() => {
                        this.isLoading = false;
                        this.$router.push("/users");
                    })
                    .catch(error => {
                        console.log("error", error);
                        this.isLoading = false;
                        this.gqlError = error;
                    });
            }
        }
    }
};
</script>

<style scoped></style>
