<template>
    <b-modal id="resetTokenSent" hide-footer title="Reminder (重新設定通知)">
        <div class="d-block text-center">
            <h3>Token以寄到您電子郵件帳號，請查閱!</h3>
        </div>
        <b-button class="mt-3" variant="outline-primary" block @click="$bvModal.hide('resetTokenSent')">確定</b-button>
    </b-modal>
</template>

<script>
export default {
    name: "ResetTokenSent"
}
</script>