<template>
    <b-modal id="logoutSuccessModal" hide-footer title="Reminder (登出系統成功通知)">
        <div class="d-block text-center">
            <h3>您已登出系統</h3>
        </div>
        <b-button class="mt-3" variant="outline-dark" block @click="$emit('logout')">確定</b-button>
    </b-modal>
</template>

<script>
export default {
    name: "LogoutSuccessModal"
}
</script>