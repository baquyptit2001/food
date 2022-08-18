<template>
    <AdminLayout ref="layout">
        <div class="d-flex justify-content-between" id="test">
            <a-typography-title>
                Danh sách món ăn
            </a-typography-title>
            <Link :href="route('admin.products.create')">
                <a-button class="me-3">
                    <template #icon>
                        <plus-outlined/>
                    </template>
                    Thêm món ăn
                </a-button>
            </Link>
        </div>
        <a-table :columns="columns" :data-source="products.data" v-if="products.data">
            <template #bodyCell="{ column, text, record }">
                <template v-if="column.key === 'action'">
                    <Link :href="route('admin.products.edit', record.slug)">
                        <a-button type="primary" class="me-3">Sửa</a-button>
                    </Link>
                    <a-popconfirm
                        title="Bạn có thật sự muốn xóa danh mục này?"
                        ok-text="Xóa"
                        cancel-text="Hủy"
                        @confirm="deleteProduct(record.slug)"
                    >
                        <a-button type="danger">Xóa</a-button>
                    </a-popconfirm>
                </template>
                <template v-if="column.key === 'image'">
                    <img :src="record.image" style="width: 200px;" :alt="record.name"/>
                </template>
            </template>
        </a-table>
        <a-skeleton active v-else/>
    </AdminLayout>
</template>

<script>
import AdminLayout from "../../../Layouts/AdminLayout.vue";
import {Link} from '@inertiajs/inertia-vue3'
import {PlusOutlined} from "@ant-design/icons-vue";
import {notification} from "ant-design-vue";

export default {
    name: "Index",
    components: {AdminLayout, PlusOutlined, Link},
    props: {
        products: Array
    },
    setup() {
        const columns = [{
            title: 'ID',
            dataIndex: 'id',
            key: 'id',
            sorter: true
        }, {
            title: 'Ảnh',
            key: 'image',
        }, {
            title: 'Tên món ăn',
            dataIndex: 'name',
            key: 'name',
            sorter: true
        }, {
            title: 'Giá',
            dataIndex: 'price',
            key: 'price',
            sorter: true
        }, {
            title: 'Giá khuyến mãi',
            dataIndex: 'discount',
            key: 'discount',
            sorter: true
        }, {
            title: 'Danh mục',
            dataIndex: 'category',
            key: 'category',
            sorter: true
        }, {
            title: 'Action',
            dataIndex: 'action',
            key: 'action'
        }];
        return {
            columns,
        }
    },
    mounted() {
        this.$refs.layout.setSelected(["5"]);
        this.$refs.layout.setBreadItems(["Food", "List"])
        document.title = "Danh sách món ăn"
    },
    methods: {
        deleteProduct(slug) {
            this.$inertia.delete(route('admin.products.destroy', slug), {
                onSuccess: () => {
                    notification.success({
                        message: 'Xóa thành công',
                        description: 'Món ăn đã được xóa',
                    });
                },
                onError: () => {
                    notification.error({
                        message: 'Xóa thất bại',
                        description: 'Xóa món ăn thất bại',
                    });
                }
            });
        }
    }
}
</script>

<style scoped>

</style>
