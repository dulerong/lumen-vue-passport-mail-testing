<template>
    <b-modal id="resetTokenSent" hide-footer title="Reminder (重新設定通知)">
        <div class="d-block text-center">
            <h3>連結已寄到您電子郵件</h3>
            <h3>請查閱!</h3>
        </div>
        <b-button class="mt-3" variant="outline-dark" block @click="$bvModal.hide('resetTokenSent')">確定</b-button>
    </b-modal>
</template>

<script>
export default {
    name: "ResetTokenSent"
}
</script>