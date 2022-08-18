<template>
    <ClientLayout ref="layout">
        <div class="row justify-content-center mt-5 mb-5">
            <div class="login_form col-md-6">
                <div class="text-center">
                    <img src="@/assets/logo.png" style="width: 250px; margin-bottom: 30px">
                    <a-typography-title :level="5" style="font-size: 30px">Quên mật khẩu</a-typography-title>
                </div>
                <div class="w-100">
                    <a-form :label-col="labelCol" :wrapper-col="wrapperCol" @submit.prevent="forgotpassword"
                            method="post">
                        <a-form-item label="Email">
                            <a-input v-model:value="form.email"/>
                        </a-form-item>
                        <a-form-item :wrapper-col="{ span: 13, offset: 9 }">
                            <a-button shape="round" type="primary" @click.prevent="forgotpassword" id="btn-submit"
                                      :loading="iconLoading">Gửi
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
    name: "ForgotPassword",
    components: {ClientLayout, Link},
    setup() {
        const form = useForm({
            email: null,
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
        this.$refs.layout.setCurrent(['login'])
    },
    data() {
        return {
            iconLoading: false,
        };
    },
    methods: {
        forgotpassword() {
            this.iconLoading = true;
            this.form.post(route('client.auth.forgot-password'), {
                onSuccess: () => {
                    notification.success({
                        message: 'Thông báo',
                        description: 'Một email đã được gửi đến địa chỉ email của bạn',
                    });
                },
                onError: (errors) => {
                    notification.error({
                        message: 'Thông báo',
                        description: getErrorMessage(errors),
                    });
                },
                onFinish: () => {
                    this.iconLoading = false;
                }
            })
        },
    },
}
</script>

<style scoped>

</style>
