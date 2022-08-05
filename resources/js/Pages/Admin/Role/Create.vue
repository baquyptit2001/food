<template>
    <AdminLayout ref="layout">
        <a-typography-title>
            Thêm mới vị trí
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
        <a-button type="primary" shape="round" size="middle" class="mt-3" @click="addRole">
            <template #icon>
                <plus-outlined/>
            </template>
            Thêm mới
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
    name: "Create",
    components: {AdminLayout, Link, PlusOutlined, RollbackOutlined},
    mounted() {
        document.title = "Tạo vị trí";
        this.$refs.layout.title = "Tạo vị trí";
        this.$refs.layout.setSelected(["10"]);
        this.$refs.layout.setBreadItems(["Role", "Create"]);
    },
    setup() {
        const form = useForm({
            name: '',
            description: '',
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
    methods: {
        addRole() {
            this.form.post(route('admin.roles.store'), {
                onSuccess: () => {
                    notification.success({
                        message: 'Thành công',
                        description: 'Thêm mới vị trí thành công',
                    });
                },
                onError: (e) => {
                    notification.error({
                        message: 'Lỗi',
                        description: e.message,
                    });
                }
            })
        }
    }
}
</script>

<style scoped>

</style>
