<template>
    <b-container> 
        <b-form action='#'>
            <h2>Enter Email Address</h2>
            <b-form-group label='Email Address' label-for="email" >
                <b-form-input id='email' name="email" type='email' v-model="email" />
            </b-form-group>
            <b-button variant="dark" @click="sendToken">Send Reset Link</b-button>
        </b-form>
        <!-- Below are codes for message modals -->
        <ResetTokenSent />
        <ResetTokenNotSent />
        <!-- Above are codes for message modals -->
        <SpinnerGreyCover /> <!-- loading spinner with grey background -->
    </b-container>
</template>

<script>
import axios from 'axios';
import { mapGetters, mapActions } from 'vuex';

import ResetTokenSent from '../../modals/ResetTokenSent'
import ResetTokenNotSent from '../../modals/ResetTokenNotSent'
import SpinnerGreyCover from '../../components/SpinnerGreyCover'

export default {
    name: 'ResetPassword',
    components: { ResetTokenSent, ResetTokenNotSent, SpinnerGreyCover },
    computed: mapGetters(['loading']),
    data(){
        return{
            email: '',
            token: '',
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
        margin-top: 10px;
    }
    @media (max-width: 800px) { 
    .container {
        width: 100%;
    }
}
</style>