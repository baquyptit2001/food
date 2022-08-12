<template>
    <AdminLayout ref="layout">
        <div class="d-flex justify-content-between" id="test">
            <a-typography-title>
                Danh sách voucher
            </a-typography-title>
            <Link :href="route('admin.promotions.create')">
                <a-button class="me-3">
                    <template #icon>
                        <plus-outlined/>
                    </template>
                    Thêm voucher
                </a-button>
            </Link>
        </div>
        <a-table :columns="columns" :data-source="promotions.data" v-if="promotions.data">
            <template #bodyCell="{ column, text, record }">
                <template v-if="column.key === 'action'">
                    <Link :href="route('admin.promotions.edit', record.slug)">
                        <a-button type="primary" class="me-3">Sửa</a-button>
                    </Link>
                    <a-popconfirm
                        title="Bạn có thật sự muốn xóa voucher này?"
                        ok-text="Xóa"
                        cancel-text="Hủy"
                        @confirm="deletePromotion(record.slug)"
                    >
                        <a-button type="danger">Xóa</a-button>
                    </a-popconfirm>
                </template>
            </template>
        </a-table>
    </AdminLayout>
</template>

<script>
import AdminLayout from "../../../Layouts/AdminLayout.vue";
import {Link} from '@inertiajs/inertia-vue3'
import {PlusOutlined} from "@ant-design/icons-vue";

export default {
    name: "Index",
    components: {AdminLayout, Link, PlusOutlined},
    mounted() {
        this.$refs.layout.setBreadItems(["Promotions", "List"]);
        this.$refs.layout.setSelected(["14"]);
        document.title = "Danh sách voucher";
    },
    props: {
        promotions: Array
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

        return {
            columns
        }
    }
}
</script>

<style scoped>

</style>
