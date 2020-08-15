<template>
    <b-modal id="saveFailModal" hide-footer title="Reminder (儲存資料失敗通知)">
        <div class="d-block text-center">
            <h3>儲存需事先登入</h3>
            <h3>頁面將轉至Login畫面!</h3>    
        </div>
        <b-button class="mt-3" variant="outline-warning" block @click="$emit('saveFail')">關閉</b-button>
    </b-modal>
</template>

<script>
export default {
    name: "SaveFailModal"
}
</script>