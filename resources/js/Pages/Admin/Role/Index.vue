<template>
    <AdminLayout ref="layout">
        <div class="d-flex justify-content-between" id="test">
            <a-typography-title>
                Danh sách vị trí
            </a-typography-title>
            <Link :href="route('admin.roles.create')">
                <a-button class="me-3">
                    <template #icon>
                        <plus-outlined/>
                    </template>
                    Thêm vị trí
                </a-button>
            </Link>
        </div>
        <a-table :columns="columns" :data-source="roles" v-if="roles">
            <template #bodyCell="{ column, text, record }">
                <template v-if="column.key === 'action'">
                    <Link :href="route('admin.roles.edit', record.id)">
                        <a-button type="primary" class="me-3">Sửa</a-button>
                    </Link>
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
    components: {AdminLayout, Link, ShoppingCartOutlined, DownOutlined, PlusOutlined},
    mounted() {
        this.$refs.layout.setSelected(["9"]);
        this.$refs.layout.setBreadItems(["Role", "List"])
        document.title = "Danh sách vị trí"
        console.log(this.roles)
    },
    props: {
        roles: Array
    },
    setup() {
        const columns = [{
            title: 'ID',
            dataIndex: 'id',
            key: 'id',
            sorter: true
        }, {
            title: 'Tên vị trí',
            dataIndex: 'name',
            key: 'name',
            sorter: true
        }, {
            title: 'Mô tả',
            dataIndex: 'description',
            key: 'description',
            sorter: true
        }, {
            title: 'Action',
            key: 'action',
        }]
        return {columns}
    }
}
</script>

<style scoped>

</style>
