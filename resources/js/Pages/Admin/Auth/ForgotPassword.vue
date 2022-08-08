<template>
    <AdminAuthLayout ref="layout">
        <a-form :label-col="labelCol" :wrapper-col="wrapperCol">
            <a-form-item label="Email">
                <a-input v-model:value="form.email"/>
            </a-form-item>
            <a-form-item :wrapper-col="{ span: 13, offset: 9 }">
                <a-button shape="round" type="primary" @click.prevent="sendEmail" :loading="iconLoading">Gửi email</a-button>
                <Link :href="route('admin.auth.login.page')">
                    <a-button shape="round" style="margin-left: 10px">Đăng nhập</a-button>
                </Link>
            </a-form-item>
        </a-form>
    </AdminAuthLayout>
</template>

<script>

import AdminAuthLayout from "../../../Layouts/AdminAuthLayout.vue";
import {useForm, Link} from "@inertiajs/inertia-vue3";
import {notification} from "ant-design-vue";
import {getErrorMessage} from "../../../Helper/stringHelper";

export default {
    name: "ForgotPassword",
    components: {AdminAuthLayout, Link},
    setup() {
        const form = useForm({
            email: '',
        });

        return {
            form,
            labelCol: {
                span: 4,
            },
            wrapperCol: {
                span: 18,
            }
        };
    },
    mounted() {
        document.title = "Quên mật khẩu";
        this.$refs.layout.title = "Quên mật khẩu";
    },
    data() {
        return {
            iconLoading: false,
        };
    },
    methods: {
        sendEmail() {
            this.iconLoading = true;
            this.form.post(route('admin.auth.forgot-password'), {
                onSuccess: () => {
                    notification.success({
                        message: 'Gửi email thành công',
                        description: 'Vui lòng kiểm tra email để thay đổi mật khẩu',
                    });
                    this.iconLoading = false;
                },
                onError: (errors) => {
                    notification.error({
                        message: 'Gửi email thất bại',
                        description: getErrorMessage(errors),
                    });
                    this.iconLoading = false;
                },
            });
        },
    },
}
</script>

<style scoped>

</style>
