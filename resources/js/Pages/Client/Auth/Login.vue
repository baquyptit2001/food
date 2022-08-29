<template>
    <ClientLayout ref="layout">
        <div class="row justify-content-center mt-5 mb-5">
            <div class="login_form col-md-6">
                <div class="text-center">
                    <img src="@/assets/logo.png" style="width: 250px; margin-bottom: 30px">
                    <a-typography-title :level="5" style="font-size: 30px">Login</a-typography-title>
                </div>
                <div class="w-100">
                    <a-form :label-col="labelCol" :wrapper-col="wrapperCol" @submit.prevent="login" method="post">
                        <a-form-item label="Email">
                            <a-input v-model:value="form.email"/>
                        </a-form-item>
                        <a-form-item label="Password">
                            <a-input type="password" v-model:value="form.password"/>
                        </a-form-item>
                        <a-form-item :wrapper-col="{ span: 13, offset: 9 }">
                            <a-button shape="round" type="primary" @click.prevent="login" id="btn-submit" htmlType="submit"
                                      :loading="iconLoading">Đăng nhập
                            </a-button>
                            <Link :href="route('client.auth.register.page')">
                                <a-button shape="round" style="margin-left: 10px">Đăng ký</a-button>
                            </Link>
                        </a-form-item>
                        <div class="w-100 text-center">
                            <Link :href="route('admin.auth.forgot-password.page')">
                                Quên mật khẩu
                            </Link>
                        </div>
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
    name: "Login",
    components: {ClientLayout, Link},
    setup() {
        const form = useForm({
            email: '',
            password: ''
        })

        return {
            form,
            labelCol: {
                span: 4,
            },
            wrapperCol: {
                span: 18,
            }
        }
    },
    mounted() {
        document.title = "Đăng nhập"
        this.$refs.layout.setCurrent(['login'])
    },
    data() {
        return {
            iconLoading: false
        }
    },
    methods: {
        login() {
            this.iconLoading = true
            this.form.post(route('client.auth.login'), {
                onSuccess: () => {
                    notification.success({
                        message: 'Thành công',
                        description: 'Bạn sẽ sớm được điều hướng'
                    })
                },
                onError: (e) => {
                    notification.error({
                        message: 'Thất bại',
                        description: getErrorMessage(e)
                    })
                },
                onFinish: () => {
                    this.iconLoading = false
                }
            })
        }
    }
}
</script>

<style scoped>

</style>
