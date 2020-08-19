<template>
    <b-modal id="saveFailModal2" hide-footer title="Reminder (儲存資料前須知)">
        <div class="d-block text-center">
            <h3>需事先讀取資料</h3>
            <h3>目前數據為0筆!</h3>
        </div>
        <b-button class="mt-3" variant="outline-danger" block @click="$bvModal.hide('saveFailModal2')">關閉</b-button>
    </b-modal>
</template>

<script>
export default {
    name: "SaveFailModal2"
}
</script>