<template>
    <AdminAuthLayout ref="layout">
        <a-form :label-col="labelCol" :wrapper-col="wrapperCol" @submit.prevent="login" method="post">
            <a-form-item label="Email">
                <a-input v-model:value="form.email"/>
            </a-form-item>
            <a-form-item label="Password">
                <a-input type="password" v-model:value="form.password"/>
            </a-form-item>
            <a-form-item :wrapper-col="{ span: 13, offset: 9 }">
                <a-button shape="round" type="primary" @click.prevent="login" id="btn-submit" :loading="iconLoading">Đăng nhập</a-button>
                <Link :href="route('admin.auth.register.page')"><a-button shape="round" style="margin-left: 10px">Đăng ký</a-button></Link>
            </a-form-item>
            <div class="w-100 text-center">
                <Link :href="route('admin.auth.forgot-password.page')">
                    Quên mật khẩu
                </Link>
            </div>
        </a-form>
    </AdminAuthLayout>
</template>

<script>
import AdminAuthLayout from "../../../Layouts/AdminAuthLayout.vue";
import {useForm, Link} from '@inertiajs/inertia-vue3'
import {notification} from "ant-design-vue";
import {getErrorMessage} from "../../../Helper/stringHelper";
import $ from 'jquery';

export default {
    name: "login",
    components: {AdminAuthLayout, Link},
    mounted() {
        document.title = "Đăng nhập";
        this.$refs.layout.title = "Đăng nhập";
        $(document).ready(function () {
            $('#btn-submit').removeAttr('type').attr('type', 'submit');
        });
    },
    setup() {
        const form = useForm({
            email: '',
            password: '',
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
    data() {
        return {
            iconLoading: false,
        };
    },
    methods: {
        login() {
            this.iconLoading = true;
            this.form.post(route('admin.auth.login'), {
                onSuccess: () => {
                    notification.success({
                        message: 'Đăng nhập thành công',
                        description: 'Hê lô bờ rô',
                    });
                },
                onError: (errors) => {
                    notification.error({
                        message: 'Đăng nhập thất bại',
                        description: getErrorMessage(errors),
                    });
                    this.iconLoading = false;
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
