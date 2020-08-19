<template>
    <div class='container'>
        <LocationFilter />
        <MotherAgeFilter />
        <BirthOrderFilter />
        <BirthGenderFilter />
        <LoadAndSave />
        <Comment />
        <DisplayResult />
        <b-table striped hover stacked="md" :items="records"></b-table>
        <SpinnerGreyCover />
    </div>
</template>

<script>
import LocationFilter from '../components/LocationFilter'
import MotherAgeFilter from '../components/MotherAgeFilter'
import BirthGenderFilter from '../components/BirthGenderFilter'
import BirthOrderFilter from '../components/BirthOrderFilter'
import DisplayResult from '../components/DisplayResult'
import LoadAndSave from '../components/LoadAndSave'
import Comment from '../components/Comment'
import SpinnerGreyCover from '../components/SpinnerGreyCover'

import { mapGetters, mapActions } from 'vuex';

export default {
    components: { 
        LocationFilter, 
        MotherAgeFilter, 
        BirthGenderFilter, 
        BirthOrderFilter, 
        Comment, 
        LoadAndSave, 
        DisplayResult, 
        SpinnerGreyCover 
    },
    computed: mapGetters(['loading', 'records']),
}
</script>