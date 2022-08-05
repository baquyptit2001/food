<template>
    <AdminAuthLayout ref="layout">
        <a-form :label-col="labelCol" :wrapper-col="wrapperCol">
            <a-form-item label="Password">
                <a-input type="password" v-model:value="form.password"/>
            </a-form-item>
            <a-form-item label="Password Confirmation">
                <a-input type="password" v-model:value="form.password_confirmation"/>
            </a-form-item>
            <a-form-item :wrapper-col="{ span: 13, offset: 9 }">
                <a-button shape="round" type="primary" @click.prevent="resetPassword">Thay đổi</a-button>
                <Link :href="route('admin.auth.login.page')">
                    <a-button shape="round" style="margin-left: 10px">Đăng nhập</a-button>
                </Link>
            </a-form-item>
        </a-form>
    </AdminAuthLayout>
</template>

<script>
import AdminAuthLayout from "../../../Layouts/AdminAuthLayout.vue";
import {Link, useForm} from "@inertiajs/inertia-vue3";
import {notification} from "ant-design-vue";
import {getErrorMessage} from "../../../Helper/stringHelper";

export default {
    name: "ResetPassword",
    components: {AdminAuthLayout, Link},
    mounted() {
        document.title = "Thay đổi mật khẩu";
        this.$refs.layout.title = "Thay đổi mật khẩu";
    },
    props: {
        token: {
            type: String,
            required: true,
        },
        email: {
            type: String,
            required: true,
        },
    },
    setup() {
        const form = useForm({
            password: '',
            password_confirmation: '',
            token: '',
            email: '',
        });

        return {
            form,
            labelCol: {
                span: 7,
            },
            wrapperCol: {
                span: 14,
            }
        };
    },
    methods: {
        resetPassword() {
            this.form.token = this.token;
            this.form.email = this.email;
            this.form.post(route('admin.auth.reset-password'), {
                onSuccess: (res) => {
                    notification.success({
                        message: "Thành công",
                        description: "Mật khẩu đã được thay đổi",
                    });
                },
                onError: (res) => {
                    notification.error({
                        message: "Lỗi",
                        description: getErrorMessage(res),
                    });
                },
            });
        },
    },
}
</script>

<style scoped>

</style>
