<template>
    <AdminLayout ref="layout">
        <div class="d-flex justify-content-between" id="test">
            <a-typography-title>
                Danh sách người dùng
            </a-typography-title>
        </div>
        <a-table :columns="columns" :data-source="users.data" v-if="users.data">
            <template #bodyCell="{ column, text, record }">
                <template v-if="column.key === 'action'">
                    <Link :href="route('admin.users.profile', record.id)"><a-button type="primary" class="me-3">Chi tiết</a-button></Link>
                    <a-button type="primary" @click="changeStatus(record.id)" :danger="record.is_active" class="me-3"
                              v-if="$page.props.user.data.role.id < record.role.id && record.id !== $page.props.user.id">
                        {{ record.is_active ? 'Ban' : 'Unban' }}
                    </a-button>
                    <a-button type="primary" @click="changeRole(record.id)" :danger="record.role.id === 2" class="me-3"
                              v-if="$page.props.user.data.role.id === 1 && record.id !== $page.props.user.id && [2, 3].includes(record.role.id)">
                        {{ record.role.id === 2 ? 'Demote' : 'Promote' }}
                    </a-button>
                </template>
                <template v-if="column.key === 'role'">
                    <a-tag :color="tagColor[0][record.role.name]">{{ record.role.name }}</a-tag>
                </template>
                <template v-if="column.key === 'status'">
                    <a-tag :danger="record.is_active">{{ record.status }}</a-tag>
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
        this.$refs.layout.setSelected(["11"]);
        this.$refs.layout.setBreadItems(["User", "List"])
        document.title = "Danh sách người dùng"
    },
    props: {
        users: Array
    },
    setup() {
        const columns = [{
            title: 'ID',
            dataIndex: 'id',
            key: 'id',
            sorter: true
        }, {
            title: 'Tên hiển thị',
            dataIndex: 'name',
            key: 'name',
            sorter: true
        }, {
            title: 'Email',
            dataIndex: 'email',
            key: 'email',
            sorter: true
        }, {
            title: 'Vị trí',
            key: 'role',
            sorter: true
        }, {
            title: 'Trạng thái',
            dataIndex: 'status',
            key: 'status',
            sorter: true
        }, {
            title: 'Action',
            dataIndex: 'action',
            key: 'action',
            sorter: true
        }];

        const tagColor = [{
            'ADMIN': "pink",
            "MODERATOR": "blue",
            "USER": "green"
        }]

        return {
            columns,
            tagColor
        }
    },
    methods: {
        changeStatus(id) {
            this.$inertia.get(route('admin.users.change-status', id))
        },
        changeRole(id) {
            this.$inertia.get(route('admin.users.change-role', id))
        }
    }
}
</script>

<style scoped>

</style>
