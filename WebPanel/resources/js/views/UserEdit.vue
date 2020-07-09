<template>
    <div id="content">
        <h1 class="content-title">Editing user {{displayUsername}}</h1>
        <hr>
        <div class="form-group">
            <label for="username">Username</label>
            <input v-model="user.username" type="text" class="form-control" name="username" id="username" placeholder="Username">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <div class="input-group">
                <input type="password" class="form-control" name="password" id="password" placeholder="Password" disabled>
                <div class="input-group-append">
                    <button v-on:click="unlockPassword" class="btn btn-danger"><i class="fas fa-lock"></i></button>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="form-check-label" for="roleSelect">Roles</label>
            <multiselect id="roleSelect" v-model="roleValue" :options="roleOptions" :multiple="true" label="name" track-by="name" :close-on-select="false" :clear-on-select="false" :preserve-search="true" placeholder="Edit the roles"></multiselect>
        </div>
        <button v-on:click="sendEdit" class="btn btn-primary">Submit</button>
    </div>
</template>

<script>
    export default {
        name: "UserEdit",
        data: function() {
            return {
                userId: this.$route.params.userId,
                displayUsername: null,
                user: {},
                roles: [],
                roleValue: null,
                roleOptions: []
            }
        },
        methods: {
            sendEdit: function(){
                axios.post(`/api/user/${this.userId}/edit`, {

                })
                    .then((response) => {
                        console.log(response);
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            },
            unlockPassword: function(){
                $('#password').removeAttr('disabled');
            },
            loadRoles: function () {
                axios.get('/api/roles')
                    .then((response) => {
                        this.roles = response.data.data;
                        this.roleOptions = this.roles;

                        this.loadUser();
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            },
            loadUser: function () {
                axios.get(`/api/user/${this.userId}/show`)
                    .then((response) => {
                        this.user = response.data.data;
                        this.displayUsername = this.user.username;

                        let _roles = this.roles;
                        let _user = this.user;

                        _user.roles.forEach(function (userRole) {
                            _roles.forEach(function (role) {
                                if (userRole.id === role.id) {
                                    userRole.name = role.name;
                                }
                            })
                        });

                        this.user = _user;
                        this.roleValue = this.user.roles;
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            }
        },
        mounted() {
            //First load the roles and then the users because the requests are async
            this.loadRoles();
        }
    }
</script>

<style scoped>

</style>
