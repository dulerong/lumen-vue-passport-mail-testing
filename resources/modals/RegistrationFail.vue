<template>
    <b-modal id="registrationFail" hide-footer title="Warning (註冊帳號失敗通知)">
        <div class="d-block text-center">
            <h3>Email帳號已被使用!</h3>
        </div>
        <b-button class="mt-3" variant="outline-danger" block @click="$bvModal.hide('registrationFail')">確定</b-button>
    </b-modal>
</template>

<script>
export default {
    name: "RegistrationFail"
}
</script>