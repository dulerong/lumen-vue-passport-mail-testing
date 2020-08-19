<template>
    <b-container>
        <b-form action='#' @submit.prevent='checkInfo'>
            <h2>Register</h2>

            <b-form-group label='Name' label-for="name">
                <b-form-input name="name" type='text' v-model="name" :state="nameState" placeholder="Enter your name"/>
                <b-form-invalid-feedback id="input-live-feedback">Enter at least 3 letters</b-form-invalid-feedback>           
            </b-form-group>

            <b-form-group label='Email' label-for="email">
                <b-form-input name="email" type='email' v-model="email" :state="emailState" placeholder="Enter your email" />
                <b-form-invalid-feedback id="input-live-feedback">Enter valid email</b-form-invalid-feedback>  
            </b-form-group>

            <b-form-group label='Password' label-for="password">
                <b-form-input name="password" type='password' v-model="password" :state="passwordState" placeholder="Enter password" />
                <b-form-invalid-feedback id="input-live-feedback">Must contain at least 6 characters</b-form-invalid-feedback>  
            </b-form-group>

            <b-form-group label='Confirm Password' label-for="password_confirmation">
                <b-form-input name="password_confirmation" type='password' v-model="password_confirmation" :state="password_confirmState" placeholder="Confirm password" />
                <b-form-invalid-feedback id="input-live-feedback">Unmatching passwords!</b-form-invalid-feedback>  
            </b-form-group>

            <b-button type="submit" variant="dark">Register</b-button>
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
    computed: {
        nameState() { return this.name.length > 2 ? true : false },
        emailState() { return this.email.indexOf('@') > -1 ? true : false },
        passwordState() { return this.password.length > 5 ? true : false },
        password_confirmState() { 
            if(this.password_confirmation.length === 0){ return false }
            else if(this.password_confirmation !== this.password){ return false }
            else{ return true }
        }
    },
    data(){
        return{
            name: '',
            email: '',
            password: '',
            password_confirmation: ''
        }
    },
    methods: {
        checkInfo(){
            if(this.nameState && this.emailState && this.passwordState && this.password_confirmState){
                this.register()
            }
        },
        register(){ 
            const data = {
                name: this.name, 
                email: this.email, 
                password: this.password, 
                password_confirmation: this.password_confirmation
            }
            this.$store.dispatch('register', data) 
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
        margin-top: 10px;
    }
    @media (max-width: 700px) { 
    .container {
        width: 100%;
    }
}
</style>