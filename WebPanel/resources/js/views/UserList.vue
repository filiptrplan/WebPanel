<template>
    <div id="content">
        <h1 class="content-title">Users</h1>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Username</th>
                <th scope="col">Roles</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tr v-for="user in users">
                <td>{{user.id}}</td>
                <td>{{user.username}}</td>
                <td><p v-for="role in user.roleNames">{{role}}  </p></td>
                <td><action-button class="btn-warning fa-user-edit" v-bind:user-id=1 api-action="edit"></action-button></td>
            </tr>
        </table>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                users: [],
                roles: []
            }
        },
        mounted() {
            //First load the roles and then the users because the requests are async
            this.loadRoles();
        },
        methods: {
            loadRoles: function () {
                axios.get('api/roles')
                    .then((response) => {
                        this.roles = response.data.data;
                        this.loadUsers();
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            },
            loadUsers: function () {
                axios.get('/api/users')
                    .then((response) => {
                        this.users = response.data.data;
                        //Match the role names to each user role IDs
                        this.users.forEach(function (user) {
                            user.roleNames = [];
                            user.roles.forEach(function (userRole) {
                                this.roles.forEach(function (role) {
                                    if (userRole === role.id) {
                                        user.roleNames.push(role.name);
                                    }
                                })
                            });
                        });
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            }
        }
    }
</script>
