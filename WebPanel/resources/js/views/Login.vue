<template>

</template>

<script>
    export default {
        name: "Login",
        mounted(){
            const data = {
                name: 'Client Name',
                redirect: 'http://example.com/callback'
            };

            axios.delete('/oauth/clients/3', data)
                .then(response => {
                    console.log(response.data);
                })
                .catch (response => {
                    // List errors on response...
                });
        }
    }


</script>

<style scoped>

</style>
