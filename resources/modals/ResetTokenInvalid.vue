<template>
    <b-modal id="resetTokenInvalid" hide-footer title="Warning (重新設定失敗通知)">
        <div class="d-block text-center">
            <h3>Token不正確!</h3>
        </div>
        <b-button class="mt-3" variant="outline-warning" block @click="$bvModal.hide('resetTokenInvalid')">確定</b-button>
    </b-modal>
</template>

<script>
export default {
    name: "ResetTokenInvalid"
}
</script>