<template>
    <ClientLayout ref="layout">
        <a-page-header
            style="border: 1px solid rgb(235, 237, 240); margin: 15px 0"
            title="Giỏ hàng"
            sub-title="Vui lòng kiểm tra kỹ giỏ hàng trước khi thanh toán"
        />
        <a-table
            :columns="columns"
            :data-source="carts.data"
        >
            <template #bodyCell="{ column, text, record }">
                <template v-if="column.key === 'product'">
                    {{ record.product.name }}
                </template>
                <template v-if="column.key === 'image'">
                    <img :src="record.product.image" style="width: 200px" />
                </template>
                <template v-if="column.key === 'price'">
                    {{ record.product.discount ?? record.product.price }}
                </template>
                <template v-if="column.key === 'action'">
                    <a-button-group>
                        <a-button type="primary" @click="updateCart(record)">
                            <EditOutlined />
                            Sửa
                        </a-button>
                        <a-button type="danger" @click="deleteCart(record)" class="ms-3">
                            <DeleteOutlined />
                            Xóa
                        </a-button>
                    </a-button-group>
                </template>
            </template>
        </a-table>
        <CartModal ref="modal" />
        <Link :href="route('client.carts.checkout')">
            <a-button type="primary" @click="checkout" shape="round">
                <ShoppingCartOutlined/>
                Thanh toán
            </a-button>
        </Link>
    </ClientLayout>
</template>

<script>
import ClientLayout from "../../../Layouts/ClientLayout.vue";
import {computed, reactive, toRefs} from "vue";
import {Link} from "@inertiajs/inertia-vue3";
import {ShoppingCartOutlined, EditOutlined, DeleteOutlined} from "@ant-design/icons-vue";
import CartModal from "../../../Component/Client/Cart/CartModal.vue";

export default {
    name: "Index",
    components: {CartModal, ClientLayout, Link, ShoppingCartOutlined, EditOutlined, DeleteOutlined},
    mounted() {
        this.$refs.layout.setCurrent(["info:2"]);
        document.title = "Giỏ hàng";
    },
    props: {
        carts: {
            type: String,
        },
    },
    setup() {
        const columns = [{
            title: 'Product',
            key: 'product',
        }, {
            title: 'Image',
            key: 'image',
        }, {
            title: 'Price',
            key: 'price',
        }, {
            title: 'Quantity',
            dataIndex: 'quantity',
        }, {
            title: 'Action',
            key: 'action',
        }];

        return {
            columns,
        };
    },
    methods: {
        checkout() {
            this.route('client.carts.checkout');
        },
        updateCart(record) {
            this.$refs.modal.visible = true;
            this.$refs.modal.form.id = record.id;
            this.$refs.modal.form.quantity = record.quantity;
            this.$refs.modal.form.name = record.product.name;
            this.$refs.modal.form.price = record.product.discount ?? record.product.price;
            this.$refs.modal.image = record.product.image;
        },
    }
}
</script>

<style scoped>

</style>
