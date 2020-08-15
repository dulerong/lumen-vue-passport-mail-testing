<template>
    <b-modal id="resetSuccessful" hide-footer title="Warning (重新設定成功通知)">
        <div class="d-block text-center">
            <h3>密碼重新設定成功!</h3>
        </div>
        <b-button class="mt-3" variant="outline-primary" block @click="$emit('resetSuccessful')">確定</b-button>
    </b-modal>
</template>

<script>
export default {
    name: "ResetTokenInvalid"
}
</script>