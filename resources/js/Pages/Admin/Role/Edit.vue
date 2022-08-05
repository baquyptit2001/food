<template>
    <AdminLayout ref="layout">
        <a-typography-title>
            Chỉnh sửa vị trí
        </a-typography-title>
        <div class="row">
            <div class="col-md-6 mt-2">
                <a-typography-title :level="5">
                    Tên vị trí
                </a-typography-title>
                <a-input v-model:value="form.name" placeholder="Tên vị trí"/>
            </div>
            <div class="col-md-6 mt-2">
                <a-typography-title :level="5">
                    Mô tả
                </a-typography-title>
                <a-textarea v-model:value="form.description" show-count :maxlength="250" rows="3" placeholder="Mô tả"/>
            </div>
        </div>
        <a-button type="primary" shape="round" size="middle" class="mt-3" @click="updateRole">
            <template #icon>
                <plus-outlined/>
            </template>
            Chỉnh sửa
        </a-button>
        <Link :href="route('admin.roles.index')">
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
import {useForm, Link} from '@inertiajs/inertia-vue3'
import {PlusOutlined, RollbackOutlined} from "@ant-design/icons-vue";
import {notification} from "ant-design-vue";

export default {
    name: "Edit",
    components: {AdminLayout, Link, PlusOutlined, RollbackOutlined},
    mounted() {
        document.title = "Chỉnh sửa vị trí";
        this.$refs.layout.title = "Chỉnh sửa vị trí";
        this.$refs.layout.setSelected(["10"]);
        this.$refs.layout.setBreadItems(["Role", "Update"]);
        this.form.name = this.role.name;
        this.form.description = this.role.description;
    },
    setup() {
        const form = useForm({
            name: '',
            description: '',
        });
        return {
            form,
        };
    },
    props: {
        role: {
            type: Object,
            required: true,
        },
    },
    methods: {
        updateRole() {
            this.form.put(route('admin.roles.update', this.role.id), {
                onSuccess: () => {
                    notification.success({
                        message: 'Thành công',
                        description: 'Chỉnh sửa vị trí thành công',
                    });
                },
                onError: (e) => {
                    notification.error({
                        message: 'Thất bại',
                        description: e.message,
                    });
                }
            });
        },
    },
}
</script>

<style scoped>

</style>
