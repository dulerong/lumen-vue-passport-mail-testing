<template>
    <b-container fluid>
            <b-row class="my-3" align-v="center">
                <b-col md="1"><label for="comment">備考欄:</label></b-col>
                <b-col md="6"><b-form-input id="comment" v-model="comment" placeholder="Coments/感想..."></b-form-input></b-col>
            </b-row>
    </b-container>
</template>

<script>
import { mapActions } from 'vuex';
export default {
    name: "Comment",
    data(){ return{ comment: '' } },
    methods: {...mapActions(['changeComment'])},
    watch:{ comment: function(val, oldVal){ this.changeComment(val) } }
}
</script>