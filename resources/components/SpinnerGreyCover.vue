<template>
    <div class="greyCover" v-if="loading">
        <div class="spinner" v-if="loading">
            <b-spinner style="width: 150px; height: 150px;" label="Loading..."/>
        </div>
    </div>
</template>

<script>
import { mapGetters } from 'vuex';
export default {
    name: 'SpinnerGreyCover',
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
    .greyCover {
        position: fixed;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        width: 100%;
        height: 100%;
        background-color: grey;
        opacity: 0.9;
    }
</style>