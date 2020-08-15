<template>
    <b-modal id="loginInfoMissing" hide-footer title="Warning (登入資料不足通知)">
        <div class="d-block text-center">
            <h3>請完整輸入電子郵件帳號及密碼!</h3>
        </div>
        <b-button class="mt-3" variant="outline-danger" block @click="$bvModal.hide('loginInfoMissing')">確定</b-button>
    </b-modal>
</template>

<script>
export default {
    name: "LoginFailModal"
}
</script>