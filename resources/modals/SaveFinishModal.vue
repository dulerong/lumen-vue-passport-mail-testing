<template>
    <b-modal id="saveFinishModal" hide-footer title="Reminder (儲存資料完成通知)">
        <div class="d-block text-center">
            <h3>資料儲存完畢</h3>
            <h3>更新頁面至DATA!</h3>    
        </div>
        <b-button class="mt-3" variant="outline-dark" block @click="$emit('loadDataPage')">關閉</b-button>
    </b-modal>
</template>

<script>
export default {
    name: "SaveFinishModal"
}
</script>