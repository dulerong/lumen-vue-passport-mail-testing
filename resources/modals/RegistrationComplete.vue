<template>
    <b-modal id="registrationComplete" hide-footer title="Reminder (註冊帳號成功通知)">
        <div class="d-block text-center">
            <h3>帳號註冊完畢，請從Login頁面登入!</h3>
        </div>
        <b-button class="mt-3" variant="outline-primary" block @click="$emit('registrationComplete')">確定</b-button>
    </b-modal>
</template>

<script>
export default {
    name: "RegistrationComplete"
}
</script>