<template>
    <ClientLayout ref="layout">
        <div class="row justify-content-center mt-5 mb-5">
            <div class="login_form col-md-6">
                <div class="text-center">
                    <img src="@/assets/logo.png" style="width: 250px; margin-bottom: 30px">
                    <a-typography-title :level="5" style="font-size: 30px">Thay đổi mật khẩu</a-typography-title>
                </div>
                <div class="w-100">
                    <a-form :label-col="labelCol" :wrapper-col="wrapperCol" @submit.prevent="resetpassword"
                            method="post">
                        <a-form-item label="Email">
                            <a-input disabled v-model:value="form.email"/>
                        </a-form-item>
                        <a-form-item label="Password">
                            <a-input type="password" v-model:value="form.password"/>
                        </a-form-item>
                        <a-form-item label="Password Confirmation">
                            <a-input type="password" v-model:value="form.password_confirmation"/>
                        </a-form-item>
                        <a-form-item :wrapper-col="{ span: 13, offset: 9 }">
                            <a-button shape="round" type="primary" @click.prevent="resetpassword" id="btn-submit"
                                      :loading="iconLoading">Cập nhật
                            </a-button>
                            <Link :href="route('client.auth.login.page')">
                                <a-button shape="round" style="margin-left: 10px">Đăng nhập</a-button>
                            </Link>
                        </a-form-item>
                    </a-form>
                </div>
            </div>
        </div>
    </ClientLayout>
</template>

<script>
import ClientLayout from "../../../Layouts/ClientLayout.vue";
import {Link, useForm} from "@inertiajs/inertia-vue3";
import {notification} from "ant-design-vue";
import {getErrorMessage} from "../../../Helper/stringHelper";

export default {
    name: "ResetPassword",
    components: {ClientLayout, Link},
    setup() {
        const form = useForm({
            email: null,
            token: null,
            password: null,
            password_confirmation: null,
        });
        return {
            form,
            labelCol: {
                span: 6,
            },
            wrapperCol: {
                span: 18,
            }
        };
    },
    data() {
        return {
            iconLoading: false,
        };
    },
    mounted() {
        document.title = "Đặt lại mật khẩu";
        this.form.email = this.email;
        this.form.token = this.token;
        this.$refs.layout.setCurrent(['login'])
    },
    props: {
        email: {
            type: String,
            required: true,
        },
        token: {
            type: String,
            required: true,
        },
    },
    methods: {
        resetpassword() {
            this.iconLoading = true;
            this.form.post(route('client.auth.reset-password'), {
                onSuccess: () => {
                    notification.success({
                        message: 'Thông báo',
                        description: 'Mật khẩu đã được cập nhật',
                    });
                },
                onError: (error) => {
                    notification.error({
                        message: 'Thông báo',
                        description: getErrorMessage(error),
                    });
                },
                onFinish: () => {
                    this.iconLoading = false;
                },
            });
        }
    },
}
</script>

<style scoped>

</style>
