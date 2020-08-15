<template>
    <b-container fluid>
        <!-- Below are codes for message modals -->
        <LogoutSuccessModal v-on:logout="logout" />
        <LogoutFailModal v-on:logoutFail="logoutFail" />
        <!-- Above are codes for message modals -->
    </b-container>
</template>

<script>   
import LogoutSuccessModal from '../../modals/LogoutSuccessModal'
import LogoutFailModal from '../../modals/LogoutFailModal'

export default {
    name: 'Logout',
    components: { LogoutSuccessModal, LogoutFailModal },
    methods: {
        logout(){             
            this.$store.dispatch('destroyToken')
                .then(res => this.$router.push({ name: 'login' })) 
        },
        logoutFail(){ this.$router.push({ name: 'login' })  }
    },
    mounted(){        
        this.$store.dispatch('clearDataAndRecord')

        if(this.$store.getters.loggedIn){
            this.$bvModal.show('logoutSuccessModal')
        }
        else{
            this.$bvModal.show('logoutFailModal')
        }
    }
}
</script>