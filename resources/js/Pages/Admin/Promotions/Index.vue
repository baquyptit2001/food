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
        <a-table :columns="columns" :data-source="promotions.data" v-if="promotions.data" :scroll="{ x: 1200, y: 1000 }">
            <template #bodyCell="{ column, text, record }">
                <template v-if="column.key === 'discount'">
                    {{ record.discount + record.type_text }}
                </template>
                <template v-if="column.key === 'action'">
                    <Link :href="route('admin.promotions.edit', record.id)">
                        <a-button type="primary" class="me-3">Sửa</a-button>
                    </Link>
                    <a-popconfirm
                        title="Bạn có thật sự muốn xóa voucher này?"
                        ok-text="Xóa"
                        cancel-text="Hủy"
                        @confirm="deletePromotion(record.id)"
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
        promotions: {
            Array,
            required: true
        }
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
        },{
            title: 'Discount',
            key: 'discount'
        }, {
            title: 'Start Date',
            dataIndex: 'start_date',
            key: 'start_date'
        }, {
            title: 'End Date',
            dataIndex: 'end_date',
            key: 'end_date'
        }, {
            title: 'Minimum Amount',
            dataIndex: 'minimum_price',
            key: 'minimum_price'
        }, {
            title: 'Maximum Discount',
            dataIndex: 'maximum_discount',
            key: 'maximum_discount'
        }, {
            title: 'Maximum Uses',
            dataIndex: 'maximum_uses',
            key: 'maximum_uses'
        }, {
            title: 'Used',
            dataIndex: 'used',
            key: 'used'
        }, {
            title: 'Status',
            dataIndex: 'status_text',
            key: 'status'
        }, {
            title: 'Actions',
            key: 'action',
            fixed: 'right',
            width: 200,
        }]

        return {
            columns
        }
    },
    methods: {
        deletePromotion(id) {
            console.log(id)
        }
    }
}
</script>

<style scoped>

</style>
