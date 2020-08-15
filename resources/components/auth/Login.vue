<template>
    <b-container>
        <b-form action='#' @submit.prevent='login' v-if="!loading">
            <h2>Login</h2>
            <b-form-group label='Your Email' label-for="username">
                <b-form-input id='username' name="username" type='email' v-model="username" />
            </b-form-group>
            <b-form-group label='Password' label-for="password">
                <b-form-input id='password' name="password" type='password' v-model="password" />
            </b-form-group>
            <b-button type="submit" variant="primary">Login</b-button>
            <p class="my-3"><router-link to="/resetpassword">Forgot your password? Reset it here.</router-link></p>
        </b-form>
        <Spinner /> <!-- Loading spinner -->
        <!-- Below are codes for message modals -->
        <LoginFailModal v-on:loginFail="loginFail" />
        <LoginInfoMissing />
        <!-- Above are codes for message modals -->
    </b-container>
</template>

<script>
import { mapGetters } from 'vuex';
import LoginFailModal from '../../modals/LoginFailModal'
import LoginInfoMissing from '../../modals/LoginInfoMissing'
import Spinner from '../../components/Spinner'

export default {
    name: 'Login',
    components: { LoginFailModal, LoginInfoMissing, Spinner },
    data(){
        return{
            username: '',
            password: '',
        }
    },
    computed: mapGetters(['loading']),
    methods: {
        login(){ 
            if(this.username === '' || this.password === ''){ this.$bvModal.show('loginInfoMissing') }
            else{ 
                this.$store.dispatch('retrieveToken', {username: this.username, password: this.password}) 
                    .then(res => {
                        this.$store.dispatch('retrieveUserName')
                        this.$router.push({ name: 'home' })
                    })
                    .catch(err => this.$bvModal.show('loginFailModal'))
            }
        },
        loginFail(){ 
            this.$bvModal.hide('loginFailModal')
            this.$router.go()
        }
    }
}
</script>

<style scoped>
    p {
        cursor: pointer;
        text-decoration: underline;
    }
    .container {
        width: 50%;
        margin-top: 40px;
    }
    @media (max-width: 700px) { 
    .container {
        width: 100%;
    }
}
</style>