<template>
    <b-modal id="loginFailModal" hide-footer title="Warning (登入系統失敗通知)">
        <div class="d-block text-center">
            <h3>電子郵件帳號或密碼錯誤!</h3>
        </div>
        <b-button class="mt-3" variant="outline-danger" block @click="$emit('loginFail')">確定</b-button>
    </b-modal>
</template>

<script>
export default {
    name: "LoginFailModal"
}
</script>