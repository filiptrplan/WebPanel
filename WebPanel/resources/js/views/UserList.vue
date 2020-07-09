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
            <tr v-for="user in usersData" :key="user.id">
                <td>{{user.id}}</td>
                <td>{{user.username}}</td>
                <td>
                    <span
                        class="badge badge-primary"
                        v-for="role in user.roles"
                        :key="role.id"
                    >{{ getRoleName(role.id)}}</span>
                </td>
                <td>
                    <action-button
                        class="btn-warning fa-user-edit"
                        :user-id="user.id"
                        api-action="edit"
                    ></action-button>
                </td>
            </tr>
        </table>
        <paginate
            v-model="pagination.page"
            :page-count="paginationInfo.lastPage"
            :clickHandler="onPaginationClick"
            :prev-text="'Prev'"
            :next-text="'Next'"
            :container-class="'pagination d-flex justify-content-center'"
            :page-class="'page-item'"
            :page-link-class="'page-link'"
            :next-class="'page-item'"
            :next-link-class="'page-link'"
            :prev-class="'page-item'"
            :prev-link-class="'page-link'"
        ></paginate>
    </div>
</template>

<script>
import { USERS, ROLE_NAMES } from "../graphql/queries";

export default {
    data() {
        return {
            pagination: {
                length: 10,
                page: 1
            },
            users: [],
            roles: []
        };
    },
    apollo: {
        users: {
            query: USERS,
            variables() {
                return {
                    first: this.pagination.length,
                    page: this.pagination.page
                };
            }
        },
        roles: ROLE_NAMES
    },
    computed: {
        usersData() {
            if (this.users != []) return this.users.data;
            else return [];
        },
        paginationInfo() {
            if (this.users != []) return this.users.paginatorInfo;
            else return [];
        },
    },
    methods: {
        onPaginationClick(pageNum){
            this.pagination.page = pageNum;
        },
        getRoleName(id) {
            return this.roles.find(role => role.id == id).name;
        }
    }
};
</script>
