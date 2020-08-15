<template>
    <b-container>
        <b-form action='#' class="mt-3">
            <h2>Enter Email Address</h2>
            <b-form-group label='Email Address' label-for="email" >
                <b-form-input id='email' name="email" type='email' v-model="email" />
            </b-form-group>
            <b-button variant="primary" @click="sendToken">Send Token</b-button>
        </b-form>
        <b-form action='#' class="mt-3">
            <h2>Enter Token and Reset Password</h2>
            <b-form-group label='Token' label-for="token" >
                <b-form-input id='token' name="token" type='text'  v-model="token" />
            </b-form-group>
            <b-form-group label='New Password' label-for="newpassword" >
                <b-form-input id='newpassword' name="newpassword" type='password' v-model="password_new" />
            </b-form-group>
            <b-form-group label='Confirm Password' label-for="confirmpassword" >
                <b-form-input id='confirmpassword' name="confirmpassword" type='password' v-model="password_confirm" />
            </b-form-group>
            <b-button variant="primary" @click="resetpassword">Reset Password</b-button>
        </b-form>
        <!-- Below are codes for message modals -->
        <ResetPasswordFail />
        <ResetTokenMissing />
        <ResetTokenSent />
        <ResetTokenNotSent />
        <ResetTokenInvalid />
        <ResetSuccessful v-on:resetSuccessful="resetSuccessful"/>
        <!-- Above are codes for message modals -->
        <SpinnerGreyCover /> <!-- loading spinner with grey background -->
    </b-container>
</template>

<script>
import axios from 'axios';
import { mapGetters, mapActions } from 'vuex';

import ResetPasswordFail from '../../modals/ResetPasswordFail'
import ResetTokenMissing from '../../modals/ResetTokenMissing'
import ResetTokenSent from '../../modals/ResetTokenSent'
import ResetTokenNotSent from '../../modals/ResetTokenNotSent'
import ResetTokenInvalid from '../../modals/ResetTokenInvalid'
import ResetSuccessful from '../../modals/ResetSuccessful'
import SpinnerGreyCover from '../../components/SpinnerGreyCover'

export default {
    name: 'ResetPassword',
    components: { ResetPasswordFail, ResetTokenMissing, ResetTokenSent, ResetTokenNotSent, ResetTokenInvalid, ResetSuccessful, SpinnerGreyCover },
    computed: mapGetters(['loading']),
    data(){
        return{
            email: '',
            token: '',
            password_new: '',
            password_confirm: '',

        }
    },
    methods: {
        sendToken(){
            const data = {email: this.email}
            this.$store.dispatch('changeLoading')
            axios.post('/email', JSON.stringify(data), { headers: {'Content-Type': 'application/json'} })
                .then(res => {
                    if(res.data.status === 'fail'){ this.$bvModal.show('resetTokenNotSent') }
                    else{ this.$bvModal.show('resetTokenSent') }
                    this.$store.dispatch('changeLoading')
                    console.log(res.data)
                })
                .catch(err => {
                    console.log(err)
                })
        },
        resetpassword(){
            if(this.password_new !== this.password_confirm){
                this.$bvModal.show('resetPasswordFail')
                this.password_new = ''
                this.password_confirm = ''
            }
            else if(!this.token){
                this.$bvModal.show('resetTokenMissing')
            }
            else{
                const data = {token: this.token, password_new: this.password_new, password_confirm: this.password_confirm}
                this.$store.dispatch('changeLoading')
                axios.post('/verifytoken', JSON.stringify(data), { headers: {'Content-Type': 'application/json'} })
                .then(res => {
                    if(res.data.status === 'fail'){
                        this.$bvModal.show('resetTokenInvalid')
                    }
                    else{ 
                        this.$bvModal.show('resetSuccessful')
                    }
                    this.$store.dispatch('changeLoading')
                    
                    console.log(res.data)
                })
                .catch(err => console.log(err))
            }
        },
        resetSuccessful(){
            this.$bvModal.hide('resetSuccessful')
            this.$router.push({ name: 'login' })
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
    }
    @media (max-width: 1100px){
    h2 {
        font-size: 24px;
    }
    }
    @media (max-width: 800px) { 
    h2 {
        font-size: 20px;
    }
    .container {
        width: 100%;
    }
}
</style>