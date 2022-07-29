<template>
    <AdminLayout ref="layout">
        <a-typography-title>
            Thêm mới danh mục
        </a-typography-title>
        <div class="row">
            <div class="col-md-6">
                <a-typography-title :level="5">
                    Tên danh mục
                </a-typography-title>
                <a-input v-model:value="form.name" placeholder="Tên danh mục"/>
            </div>
            <div class="col-md-6">
                <a-typography-title :level="5">
                    Danh mục cha
                </a-typography-title>
                <a-select
                    v-model:value="form.parent_id"
                    show-search
                    placeholder="Select a category"
                    style="width: 200px"
                    :allowClear="true"
                >
                    <a-select-option v-for="item in categories" :key="item.id" :value="item.id">
                        {{ item.name }}
                    </a-select-option>
                </a-select>
            </div>
            <div class="col-md-6 mt-2">
                <a-typography-title :level="5">
                    Mô tả
                </a-typography-title>
                <a-textarea v-model:value="form.description" show-count :maxlength="250" rows="3" placeholder="Mô tả"/>
            </div>
        </div>
        <a-button type="primary" shape="round" size="middle" class="mt-3" @click="addCategory">
            <template #icon>
                <plus-outlined/>
            </template>
            Thêm mới
        </a-button>
        <Link :href="route('categories.index')">
            <a-button shape="round" size="middle" class="mt-3 ms-3">
                <template #icon>
                    <rollback-outlined />
                </template>
                Quay lại
            </a-button>
        </Link>

    </AdminLayout>
</template>

<script>
import AdminLayout from "../../../Layouts/AdminLayout.vue";
import {useForm} from '@inertiajs/inertia-vue3'
import {PlusOutlined, RollbackOutlined} from "@ant-design/icons-vue";
import {notification} from "ant-design-vue";
import {Link} from '@inertiajs/inertia-vue3'

export default {
    name: "Create",
    components: {AdminLayout, PlusOutlined, RollbackOutlined, Link},
    setup() {
        const form = useForm({
            name: '',
            description: '',
            parent_id: null,
        });

        return {
            form,
        };
    },
    props: {
        categories: Array,
    },
    mounted() {
        this.$refs.layout.setSelected(["4"]);
        this.$refs.layout.setBreadItems(["Danh mục đồ ăn", "Thêm mới"]);
        document.title = "Tạo danh mục đồ ăn";
        console.log(this.categories);
    },
    methods: {
        addCategory() {
            this.form.post(route('categories.store'), {
                onSuccess: () => {
                    notification.success({
                        message: 'Thành công',
                        description: 'Thêm mới danh mục thành công',
                    });
                },
                onError: () => {
                    notification.error({
                        message: 'Thất bại',
                        description: 'Thêm mới danh mục thất bại',
                    });
                },
            });
        },
    },
}
</script>

<style scoped>

</style>
