<template>
    <div class="container-fluid row">
        <div class="sidebar col-md-2">
            <div class="sidebar-menu">
                <router-link to="/users" class="sidebar-item">
                    <p>Users</p>
                    <div class="dropdown-divider"></div>
                </router-link>
            </div>
        </div>
        <div class="container col-md-10">
            <router-view></router-view>
        </div>
    </div>
</template>

<script>
    export default {
        name: "App"
    }
</script>

<style scoped>

</style>
