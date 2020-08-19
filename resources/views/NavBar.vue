<template>
    <b-navbar toggleable="lg" type="dark" variant="dark">
        <div class="container">
            <b-navbar-brand>2019年新北市生育資料 <span class="usernameBar">{{ username }}</span></b-navbar-brand>
            <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>
            <b-collapse id="nav-collapse" is-nav>
                <b-navbar-nav class="ml-auto">
                    <b-nav-item class="usernameNav">{{ username }}</b-nav-item>
                    <b-nav-item                 ><router-link to="/"         class="nav-link">Home</router-link></b-nav-item>
                    <b-nav-item v-if="loggedIn" ><router-link to="/data"     class="nav-link">Data</router-link></b-nav-item>
                    <b-nav-item                 ><router-link to="/about"    class="nav-link">About</router-link></b-nav-item>
                    <b-nav-item v-if="!loggedIn"><router-link to="/login"    class="nav-link">Login</router-link></b-nav-item>
                    <b-nav-item v-if="!loggedIn"><router-link to="/register" class="nav-link">Register</router-link></b-nav-item>
                    <b-nav-item v-if="loggedIn" ><router-link to="/logout"   class="nav-link">Logout</router-link></b-nav-item>
                </b-navbar-nav>
            </b-collapse>
        </div>
    </b-navbar>
</template>

<script>
import axios from 'axios'
export default {
    name: "NavBar",
    computed: {
        loggedIn(){ return this.$store.getters.loggedIn },
        username(){
            const username = this.$store.getters.username

            if(username){ return 'User : ' + username.charAt(0).toUpperCase() + username.slice(1) }
            else{ return 'User : Guest' }
        }
    },
}
</script>

<style scoped>
    .usernameNav {
        display: none;
    }
    @media (max-width: 700px){
        .usernameBar {
            display: none;
        }
        .usernameNav {
            display: block;
        }
    }
</style>