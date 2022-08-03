<template>
    <AdminAuthLayout ref="layout">
        <a-form :label-col="labelCol" :wrapper-col="wrapperCol">
            <a-form-item label="Display Name">
                <a-input v-model:value="form.name"/>
            </a-form-item>
            <a-form-item label="Email">
                <a-input v-model:value="form.email"/>
            </a-form-item>
            <a-form-item label="Password">
                <a-input type="password" v-model:value="form.password"/>
            </a-form-item>
            <a-form-item label="Password Confirmation">
                <a-input type="password" v-model:value="form.password_confirmation"/>
            </a-form-item>
            <a-form-item :wrapper-col="{ span: 13, offset: 9 }">
                <a-button shape="round" type="primary" @click.prevent="register">Đăng ký</a-button>
                <Link :href="route('auth.login.page')">
                    <a-button shape="round" style="margin-left: 10px">Đăng nhập</a-button>
                </Link>
            </a-form-item>
        </a-form>
    </AdminAuthLayout>
</template>

<script>

import {useForm, Link} from '@inertiajs/inertia-vue3'
import AdminAuthLayout from '../../../Layouts/AdminAuthLayout.vue'
import {getErrorMessage} from "../../../Helper/stringHelper";
import {notification} from "ant-design-vue";

export default {
    name: "Register",
    components: {useForm, Link, AdminAuthLayout},
    mounted() {
        document.title = "Đăng ký";
        this.$refs.layout.title = "Đăng ký";
    },
    setup() {
        const form = useForm({
            name: '',
            email: '',
            password: '',
            password_confirmation: '',
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
    methods: {
        register() {
            this.form.post(route('auth.register'), {
                onSuccess: (res) => {
                    notification.success({
                        message: 'Đăng ký thành công',
                        description: 'Bạn đã đăng ký thành công, vui lòng đăng nhập',
                    });
                },
                onError: (errors) => {
                    notification.error({
                        message: 'Đăng ký thất bại',
                        description: getErrorMessage(errors),
                    });
                }
            });
        },
        reset() {
            this.form.reset();
        }
    }
}
</script>

<style scoped>

</style>
