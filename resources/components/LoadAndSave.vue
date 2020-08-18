<template>
    <b-container fluid >
        <b-row class="my-3" align-v="center">
            <b-col class="my-1" md="1"><label>讀取:</label></b-col>
            <b-col class="my-1" md="2"><b-button id="loadButton" variant="outline-dark" @click="fetch">Load Data</b-button></b-col>
            <b-col class="my-1" md="1"><label>儲存:</label></b-col>
            <b-col class="my-1" md="2"><b-button id="saveButton" variant="outline-dark" @click="save">Save Data</b-button></b-col>
        </b-row>
        <!-- below is code for modal dialogs-->
        <LoadModal />
        <SaveModal />
        <SaveFinishModal v-on:loadDataPage="loadDataPage" />
        <SaveFailModal v-on:saveFail="saveFail" />
        <!-- above is code for modal dialogs-->
    </b-container>

</template>

<script>
import { mapGetters, mapActions } from 'vuex';
import LoadModal from '../modals/LoadModal'
import SaveModal from '../modals/SaveModal'
import SaveFinishModal from '../modals/SaveFinishModal'
import SaveFailModal from '../modals/SaveFailModal'

export default {
    name: "LoadAndSave",
    components: { LoadModal, SaveModal, SaveFinishModal, SaveFailModal },
    computed: mapGetters(['locationSelected', 'ageSelected', 'records']),
    methods: { 
        ...mapActions(['fetchData', 'saveData']),
        fetch(){
            if(!this.locationSelected.length || !this.ageSelected.length){this.$bvModal.show('loadModal')}
            else{this.fetchData()}
        },
        async save(){
            if(!this.$store.getters.loggedIn){ this.$bvModal.show('saveFailModal') }
            else{
                if(!this.records.length){ this.$bvModal.show('saveModal')}
                else{
                    await this.saveData()
                    this.$bvModal.show('saveFinishModal')
                }
            }
        },
        loadDataPage(){
            this.$bvModal.hide('saveFinishModal')
            let vm = this
            setTimeout(function(){ vm.$router.push('data') }, 1000);
        },
        saveFail(){ this.$router.push({ name: 'login' }) }
        
    },
}
</script>

