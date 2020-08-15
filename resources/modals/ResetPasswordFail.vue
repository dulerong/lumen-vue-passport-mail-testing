<template>
    <b-modal id="resetPasswordFail" hide-footer title="Warning (重新設定失敗通知)">
        <div class="d-block text-center">
            <h3>輸入密碼不一致!</h3>
        </div>
        <b-button class="mt-3" variant="outline-warning" block @click="$bvModal.hide('resetPasswordFail')">確定</b-button>
    </b-modal>
</template>

<script>
export default {
    name: "ResetPasswordFail"
}
</script>