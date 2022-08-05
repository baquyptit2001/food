<template>
    <AdminLayout ref="layout">
        <div class="d-flex justify-content-between" id="test">
            <a-typography-title>
                Danh sách danh mục
            </a-typography-title>
            <Link :href="route('admin.categories.create')">
                <a-button class="me-3">
                    <template #icon>
                        <plus-outlined/>
                    </template>
                    Thêm danh mục
                </a-button>
            </Link>
        </div>
        <a-table :columns="columns" :data-source="categories.data" v-if="categories.data">
            <template #bodyCell="{ column, text, record }">
                <template v-if="column.key === 'action'">
                    <Link :href="route('admin.categories.edit', record.slug)">
                        <a-button type="primary" class="me-3">Sửa</a-button>
                    </Link>
                    <a-popconfirm
                        title="Bạn có thật sự muốn xóa danh mục này?"
                        ok-text="Xóa"
                        cancel-text="Hủy"
                        @confirm="deleteCategory(record.slug)"
                    >
                        <a-button type="danger">Xóa</a-button>
                    </a-popconfirm>
                </template>
            </template>
        </a-table>
        <a-skeleton active v-else/>
    </AdminLayout>
</template>

<script>
import AdminLayout from "../../../Layouts/AdminLayout.vue";
import {ShoppingCartOutlined, DownOutlined, PlusOutlined} from "@ant-design/icons-vue";
import {Link} from '@inertiajs/inertia-vue3'

export default {
    name: "Index",
    components: {AdminLayout, ShoppingCartOutlined, DownOutlined, PlusOutlined, Link},
    mounted() {
        this.$refs.layout.setSelected(["3"]);
        this.$refs.layout.setBreadItems(["Category", "List"])
        document.title = "Danh mục đồ ăn"
        console.log(this.categories)

    },
    props: {
        categories: Array
    },
    setup() {
        const columns = [{
            title: 'ID',
            dataIndex: 'id',
            key: 'id',
            sorter: true
        }, {
            title: 'Name',
            dataIndex: 'name',
            key: 'name'
        }, {
            title: 'Description',
            dataIndex: 'description',
            key: 'description'
        }, {
            title: 'Parent',
            dataIndex: 'parent',
            key: 'parent'
        }, {
            title: 'Actions',
            key: 'action'
        }]

        return {columns}
    },
    methods: {
        deleteCategory(id) {
            this.$inertia.delete(route('admin.categories.destroy', id))
        }
    }
}
</script>

<style scoped>

</style>
