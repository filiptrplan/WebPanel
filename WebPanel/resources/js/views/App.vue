<template>
    <div class="container-fluid row">
        <div class="sidebar col-md-2">
            <div class="sidebar-menu">
                <router-link to="/users" class="sidebar-item">
                    <p>Users</p>
                    <div class="dropdown-divider"></div>
                </router-link>
                <a @click="logout()" class="sidebar-item">
                    <p>Logout</p>
                    <div class="dropdown-divider"></div>
                </a>
            </div>
        </div>
        <div class="container col-md-10">
            <router-view></router-view>
        </div>
    </div>
</template>

<script>
import { mapActions } from "vuex";

export default {
    name: "App",
    methods: {
        ...mapActions({
            storeLogout: "auth/logout"
        }),
        logout() {
            this.storeLogout().then(() => {
                this.$router.push('/login');
            })
            .catch((error) => {
                console.log(error);
            });
        }
    }
};
</script>

<style scoped></style>
