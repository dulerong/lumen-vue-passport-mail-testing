<template>
    <b-form-checkbox-group v-model="selected" name="selected">
        <div class="mt-3">Mother Age Selected: <strong>{{ ageSelected }}</strong></div>
        <b-container>
            <b-row>
                <b-col md><b-form-checkbox value="1.未滿15歲">未滿15歲</b-form-checkbox></b-col>
                <b-col md><b-form-checkbox value="2.15～19歲">15～19歲</b-form-checkbox></b-col>
                <b-col md><b-form-checkbox value="3.20～24歲">20～24歲</b-form-checkbox></b-col>
                <b-col md><b-form-checkbox value="4.25～29歲">25～29歲</b-form-checkbox></b-col>
                <b-col md><b-form-checkbox value="5.30～34歲">30～34歲</b-form-checkbox></b-col>
                <b-col md><b-form-checkbox value="6.35～39歲">35～39歲</b-form-checkbox></b-col>
            </b-row>
            <b-row>
                <b-col md><b-form-checkbox value="7.40～44歲">40～44歲</b-form-checkbox></b-col>
                <b-col md><b-form-checkbox value="8.45～49歲">45～49歲</b-form-checkbox></b-col>
                <b-col md><b-form-checkbox value="9.50歲以上">50歲以上</b-form-checkbox></b-col>
                <b-col md></b-col>
                <b-col md></b-col>
                <b-col md></b-col>
            </b-row>
        </b-container>
    </b-form-checkbox-group>
</template>

<script>
import { mapGetters, mapActions } from 'vuex';
export default {
    name: "MotherAgeFilter",
    data(){ return{ selected: [] } },
    computed: {
        selectedSorted(){
            // helps to sort age range before submitting store
            var newArray = this.selected.sort(function(a, b){ return a[0] - b[0] })

            return newArray.map(age => age = age.slice(2))
        },
        ...mapGetters(['ageSelected']),
    },
    methods: {...mapActions(['changeAge'])},
    watch:{ selectedSorted: function(val){ this.changeAge(val) }}
}
</script>