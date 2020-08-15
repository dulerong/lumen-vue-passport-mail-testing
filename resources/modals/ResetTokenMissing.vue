<template>
    <b-modal id="resetTokenMissing" hide-footer title="Warning (重新設定失敗通知)">
        <div class="d-block text-center">
            <h3>請輸入Token!</h3>
        </div>
        <b-button class="mt-3" variant="outline-warning" block @click="$bvModal.hide('resetTokenMissing')">確定</b-button>
    </b-modal>
</template>

<script>
export default {
    name: "ResetTokenMissing"
}
</script>