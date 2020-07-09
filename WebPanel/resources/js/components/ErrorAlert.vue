<template>
    <div class="alert alert-danger" :class="{hidden: !isMessage}" role="alert">
        {{ message }}
    </div>
    
</template>

<script>
    export default {
        name: "ErrorAlert",
        props: ['graphQLerror'],
        computed: {
            message () {
                if(this.graphQLerror){
                    return this.graphQLerror[0].extensions.reason; 
                } else {
                    return "";
                }
            },
            isMessage() {
                if(this.message != ""){
                    return true;
                } else {
                    return false;
                }
            }
        },
    }
</script>

<style scoped>
    .hidden {
        display: none;
    }
</style>