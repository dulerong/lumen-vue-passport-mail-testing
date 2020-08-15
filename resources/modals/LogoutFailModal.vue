<template>
    <b-modal id="logoutFailModal" hide-footer title="Warning (登出系統失敗通知)">
        <div class="d-block text-center">
            <h3>您還未登入!</h3>
        </div>
        <b-button class="mt-3" variant="outline-danger" block @click="$emit('logoutFail')">確定</b-button>
    </b-modal>
</template>

<script>
export default {
    name: "LogoutFailModal"
}
</script>