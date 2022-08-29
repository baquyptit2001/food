<template>
    <ClientLayout ref="layout">
        <div class="mt-5">
            <a-button @click="openListModal" class="ms-3">
                Address List
            </a-button>
        </div>
        <!--        <AddressModal ref="modal"/>-->
        <AddressListModal ref="list" :tinhs="tinhs" :addresses="addresses.data"/>
        <div class="row pt-5">
            <div class="col-lg-6 text-left">
                <a-form-item label="Người nhận">
                    <a-input v-model:value="form.name" disabled/>
                </a-form-item>
                <a-form-item label="Tỉnh/Thành phố">
                    <a-input v-model:value="form.tinh" disabled/>
                </a-form-item>
                <a-form-item label="Quận/Huyện">
                    <a-input v-model:value="form.huyen" disabled/>
                </a-form-item>
                <a-form-item label="Xã/Phường">
                    <a-input v-model:value="form.xa" disabled/>
                </a-form-item>
                <a-form-item label="Địa chỉ">
                    <a-input v-model:value="form.address" disabled/>
                </a-form-item>
                <a-form-item label="SĐT">
                    <a-input v-model:value="form.phone" disabled/>
                </a-form-item>
            </div>
            <div class="col-lg-6">
                <a-table
                    :columns="columns"
                    :data-source="carts.data"
                >
                    <template #bodyCell="{ column, text, record }">
                        <template v-if="column.key === 'product'">
                            {{ record.product.name }}
                        </template>
                        <template v-if="column.key === 'image'">
                            <img :src="record.product.image" style="width: 150px"/>
                        </template>
                        <template v-if="column.key === 'price'">
                            {{ record.product.discount ?? record.product.price }}
                        </template>
                    </template>
                    <template #footer><span style="font-weight: bold;">Total:</span>
                        {{ Intl.NumberFormat().format(total) + ' đ' }}
                    </template>
                </a-table>
            </div>
        </div>
        <div class="row justify-content-center">
            <a-button style="width: 150px;" type="primary" @click="checkout" shape="round">
                <ShoppingCartOutlined/>
                Thanh toán
            </a-button>
        </div>
    </ClientLayout>
</template>

<script>
import ClientLayout from "../../../Layouts/ClientLayout.vue";
import AddressModal from "../../../Component/Client/Cart/AddressModal.vue";
import {useForm} from "@inertiajs/inertia-vue3";
import {ShoppingCartOutlined} from "@ant-design/icons-vue";
import AddressListModal from "../../../Component/Client/Cart/AddressListModal.vue";

export default {
    name: "Checkout",
    components: {AddressListModal, AddressModal, ClientLayout, ShoppingCartOutlined},
    props: {
        tinhs: {
            type: Array,
        },
        carts: {
            type: Array,
        },
        total: {
            type: Number,
        },
        addresses: {
            type: Array,
        },
    },
    mounted() {
        if (this.addresses.data.length > 0) {
            this.setForm(this.addresses.data[0]);
        } else {
            this.form.reset()
        }
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
            key: 'quantity',
            dataIndex: 'quantity',
        }];

        const form = useForm({
            name: "Nguyễn Bá Quý",
            phone: "0973043445",
            address: "Chính Kinh",
            tinh: "Hà Nội",
            huyen: "Thanh Xuân",
            xa: "Nhân Chính",
        });

        return {
            columns,
            form,
        };
    },
    methods: {
        openListModal() {
            this.$refs.list.visible = true;
        },
        setForm(selectedAddress) {
            this.form.name = selectedAddress.receiver;
            this.form.phone = selectedAddress.phone;
            this.form.address = selectedAddress.address;
            this.form.tinh = selectedAddress.tinh.name;
            this.form.huyen = selectedAddress.quan.name;
            this.form.xa = selectedAddress.xa.name;
        }
    },

}
</script>

<style scoped>

</style>
