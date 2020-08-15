<template>
    <b-modal id="resetTokenNotSent" hide-footer title="Reminder (重新設定失敗通知)">
        <div class="d-block text-center">
            <h3>此Email沒註冊在系統內!</h3>
        </div>
        <b-button class="mt-3" variant="outline-warning" block @click="$bvModal.hide('resetTokenNotSent')">確定</b-button>
    </b-modal>
</template>

<script>
export default {
    name: "ResetTokenNotSent"
}
</script>