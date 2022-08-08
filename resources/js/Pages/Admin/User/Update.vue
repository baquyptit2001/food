<template>
    <AdminLayout ref="layout">
        <a-typography-title>
            Thêm mới danh mục
        </a-typography-title>
        <div class="row">
            <div class="col-md-6">
                <a-typography-title :level="5">
                    Tên hiển thị
                </a-typography-title>
                <a-input v-model:value="form.name" placeholder="Tên danh mục"/>
            </div>
            <div class="col-md-6">
                <a-typography-title :level="5">
                    Vị trí
                </a-typography-title>
                <a-select
                    v-model:value="form.role_id"
                    show-search
                    placeholder="Select a category"
                    style="width: 200px"
                    :allowClear="true"
                    disabled
                >
                    <a-select-option v-for="item in roles" :key="item.id" :value="item.id">
                        {{ item.name }}
                    </a-select-option>
                </a-select>
            </div>
            <a-divider>Để trống nếu không cần thay đổi</a-divider>
            <div class="col-md-6">
                <a-typography-title :level="5">
                    Mật khẩu
                </a-typography-title>
                <a-input type="password" v-model:value="form.password" placeholder="Mật khẩu"/>
            </div>
            <div class="col-md-6">
                <a-typography-title :level="5">
                    Xác nhận mật khẩu
                </a-typography-title>
                <a-input type="password" v-model:value="form.password_confirmation" placeholder="Xác nhận mật khẩu"/>
            </div>
        </div>
        <a-button type="primary" shape="round" size="middle" class="mt-3" @click="updateProfile" :loading="loading">
            <template #icon>
                <edit-outlined/>
            </template>
            Cập nhật
        </a-button>
        <Link :href="route('admin.users.profile', $page.props.user.data.id)">
            <a-button shape="round" size="middle" class="mt-3 ms-3">
                <template #icon>
                    <rollback-outlined/>
                </template>
                Quay lại
            </a-button>
        </Link>
    </AdminLayout>
</template>

<script>

import AdminLayout from "../../../Layouts/AdminLayout.vue";
import {Link} from '@inertiajs/inertia-vue3'
import {useForm} from '@inertiajs/inertia-vue3'
import {getErrorMessage} from "../../../Helper/stringHelper";
import {notification} from "ant-design-vue";
import {EditOutlined, RollbackOutlined} from "@ant-design/icons-vue";

export default {
    name: "Update",
    components: {AdminLayout, Link, EditOutlined, RollbackOutlined},
    mounted() {
        this.$refs.layout.setSelected(["7"]);
        this.$refs.layout.setBreadItems(["User", "Profile", "Update"]);
        document.title = "Cập nhật thông tin cá nhân"
        this.form.name = this.$page.props.user.data.name;
        this.form.role_id = this.$page.props.user.data.role.id;
    },
    setup() {
        const form = useForm({
            name: '',
            role_id: '',
            password: null,
            password_confirmation: null,
        });

        return {
            form,
        }

    },
    props: {
        roles: {
            type: Array,
            required: true,
        },
    },
    data() {
        return {
            loading: false,
        }
    },
    methods: {
        updateProfile() {
            this.loading = true;
            this.form.put(route('admin.users.update'), {
                onSuccess: () => {
                    notification.success({
                        message: 'Thành công',
                        description: "Cập nhật thông tin cá nhân thành công",
                    });
                    this.loading = false;
                },
                onError: (errors) => {
                    // console.log(getErrorMessage(errors));
                    notification.error({
                        message: 'Lỗi',
                        description: getErrorMessage(errors),
                    });
                    this.loading = false;
                }
            });
        }
    }
}
</script>

<style scoped>

</style>
