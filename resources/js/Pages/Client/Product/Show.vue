<template>
    <ClientLayout ref="layout">
        <ProductModal ref="modal" />
        <a-page-header
            style="border: 1px solid rgb(235, 237, 240); margin-top: 15px"
            :title="product.data.name"
            :sub-title="product.data.description"
            @back="() => null"
        />
        <div class="row mt-3">
            <div class="col-lg-5">
                <img :src="product.data.image" style="width: 100%;">
            </div>
            <div class="col-lg-7">
                <a-typography-title>
                    {{ product.data.name }}
                </a-typography-title>
                <div>
                    Lượt bán: 96
                </div>
                <div>
                    Mô tả: {{ product.data.description }}
                </div>
                <div style="font-size: 20px">
                    <a-typography-text delete type="secondary">
                        {{ Intl.NumberFormat().format(product.data.price) + 'đ' }}
                    </a-typography-text>
                    <a-typography-text strong style="margin-left: 10px">
                        {{ Intl.NumberFormat().format(product.data.discount ?? product.data.price) + 'đ' }}
                    </a-typography-text>
                </div>
                <div style="margin-top: 20px">
                    <div class="mb-3">
                        <a-input-number
                            v-model:value="form.quantity"
                            min="1"
                        />
                    </div>
                    <a-button type="primary" @click="addToCart" shape="round">
                        <ShoppingCartOutlined/>
                        Thêm vào giỏ hàng
                    </a-button>
                </div>
            </div>
        </div>
        <a-page-header
            style="border: 1px solid rgb(235, 237, 240); margin-top: 15px"
            title="Có thể bạn cũng sẽ thích"
        />
        <div class="row mt-3">
            <div class="col-3">
                <a-card hoverable style="width: 100%">
                    <template #cover>
                        <img
                            alt="example"
                            :src="product.data.image"
                        />
                    </template>
                    <template #actions>
                        <eye-outlined @click="openModal(product.data)" key="view"/>
                        <shopping-cart-outlined key="cart"/>
                    </template>
                    <a-card-meta>
                        <template #title>
                            <Link :href="route('client.products.show', product.data.slug)">
                                <a-typography-text strong class="d-block">{{ product.data.name }}</a-typography-text>
                            </Link>
                            <a-typography-text delete type="secondary" v-if="product.data.discount">
                                {{ Intl.NumberFormat().format(product.data.price) + 'đ' }}
                            </a-typography-text>
                            <a-typography-text strong style="margin-left: 10px">
                                {{ Intl.NumberFormat().format(product.data.discount ?? product.data.price) + 'đ' }}
                            </a-typography-text>
                        </template>
                    </a-card-meta>
                </a-card>
            </div>
        </div>
    </ClientLayout>
</template>

<script>
import ClientLayout from "../../../Layouts/ClientLayout.vue";
import {
    SettingOutlined,
    EditOutlined,
    EllipsisOutlined,
    EyeOutlined,
    ShoppingCartOutlined,
    SearchOutlined
} from "@ant-design/icons-vue";
import {useForm, Link} from '@inertiajs/inertia-vue3';
import ProductModal from "../../../Component/Client/Home/ProductModal.vue";

export default {
    name: "Show",
    components: {ProductModal, ClientLayout, ShoppingCartOutlined, Link, EyeOutlined},
    props: {
        product: {
            type: Object,
            required: true
        }
    },
    setup() {
        const form = useForm({
            quantity: 1
        })

        return {
            form,
        }
    },
    mounted() {
        this.$refs.layout.setCurrent(["asdf"]);
        document.title = "Vạn món ngon, bon cả mồm";
    },
    methods: {
        openModal(product) {
            this.$refs.modal.visible = true;
            this.$refs.modal.product = product;
        }
    }
}
</script>

<style scoped>

</style>
