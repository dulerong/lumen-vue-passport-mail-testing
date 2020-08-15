<template>
    <div class="spinner" v-if="loading">
        <b-spinner style="width: 150px; height: 150px;" label="Loading..."/>
    </div>
</template>

<script>
import { mapGetters } from 'vuex';
export default {
    name: 'Spinner',
    computed: mapGetters(['loading']),

}
</script>

<style scoped>
    .spinner {
        position: fixed;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
    }
</style>