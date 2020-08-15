<template>
    <b-container>
        <b-form action='#' @submit.prevent='register'>
            <h2>Register</h2>

            <b-form-group label='Name' label-for="name">
                <b-form-input id='name' name="name" type='text' v-model="name" />
            </b-form-group>

            <b-form-group label='Email' label-for="email">
                <b-form-input id='email' name="email" type='email' v-model="email" />
            </b-form-group>

            <b-form-group label='Password' label-for="password">
                <b-form-input id='password' name="password" type='password' v-model="password" />
            </b-form-group>

            <b-button type="submit" variant="primary">Register</b-button>
        </b-form>
        <!-- Below are codes for message modals -->
        <RegistrationComplete v-on:registrationComplete="registrationComplete" />
        <RegistrationFail />
        <!-- Above are codes for message modals -->
    </b-container>
</template>

<script>
import RegistrationComplete from '../../modals/RegistrationComplete'
import RegistrationFail from '../../modals/RegistrationFail'
export default {
    name: 'Register',
    components: { RegistrationComplete, RegistrationFail },
    data(){
        return{
            name: '',
            email: '',
            password: ''
        }
    },
    methods: {
        register(){ 
            this.$store.dispatch('register', {name: this.name, email: this.email, password: this.password}) 
                .then(res => this.$bvModal.show('registrationComplete'))
                .catch(err => this.$bvModal.show('registrationFail'))
        },
        registrationComplete(){ this.$router.push({ name: 'login' }) }
    }
}
</script>

<style scoped>
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