<template>
    <ClientLayout ref="layout">
        <div class="row justify-content-center mt-5 mb-5">
            <div class="login_form col-md-6">
                <div class="text-center">
                    <img src="@/assets/logo.png" style="width: 250px; margin-bottom: 30px">
                    <a-typography-title :level="5" style="font-size: 30px">Register</a-typography-title>
                </div>
                <div class="w-100">
                    <a-form :label-col="labelCol" :wrapper-col="wrapperCol" @submit.prevent="login" method="post">
                        <a-form-item label="Display name">
                            <a-input v-model:value="form.name"/>
                        </a-form-item>
                        <a-form-item label="Email">
                            <a-input v-model:value="form.email"/>
                        </a-form-item>
                        <a-form-item label="Password">
                            <a-input type="password" v-model:value="form.password"/>
                        </a-form-item>
                        <a-form-item :wrapper-col="{ span: 13, offset: 9 }">
                            <a-button shape="round" type="primary" @click.prevent="register" id="btn-submit"
                                      :loading="iconLoading">Đăng ký
                            </a-button>
                            <Link :href="route('client.auth.login.page')">
                                <a-button shape="round" style="margin-left: 10px">Đăng nhập</a-button>
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
    name: "Register",
    mounted() {
        document.title = "Đăng ký";
        this.$refs.layout.setCurrent(['login'])
    },
    components: {ClientLayout, Link},
    setup() {
        const form = useForm({
            name: '',
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
    data() {
        return {
            iconLoading: false
        }
    }

}
</script>

<style scoped>

</style>
