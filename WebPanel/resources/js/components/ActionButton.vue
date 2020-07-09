<template>
    <i v-on:click="navigate" class="action btn fas"></i>
</template>

<script>
    export default {
        name: "ActionButton",
        props: {
            userId:{
                type: Number,
                required: true
            },
            apiAction:{
                type: String,
                required: true
            }
        },
        data: function() {
            return {

            }
        },
        methods: {
            navigate: function() {
                this.$router.push({name: `user.${this.apiAction}`, params: { userId: this.userId }});
            }
        }
    }
</script>

<style scoped>
    .action{
        padding: 7px;
        margin-left: 5px;
    }
</style>
