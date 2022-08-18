<template>
    <ClientLayout ref="layout">
        <Hero/>
        <ProductModal ref="modal"/>
        <div class="hero-banner">
            <img src="@/assets/hero/herobanner.jpg" style="margin-top: 15px; width: 100%"/>
            <a-input placeholder="Search" class="input-search shadow">
                <template #prefix>
                    <search-outlined/>
                </template>
            </a-input>
        </div>
        <div class="banner">
            <img src="@/assets/hero/banner.jpg" style="margin-top: 15px; width: 100%">
        </div>
        <a-page-header
            style="border: 1px solid rgb(235, 237, 240); margin-top: 15px"
            title="Hot"
            sub-title="Món bán chạy nhất"
        />
        <div class="row mt-3 justify-content-around">
            <div class="col-lg-3 col-md-6" v-for="product in products.data">
                <a-card hoverable style="width: 300px">
                    <template #cover>
                        <img
                            alt="example"
                            :src="product.image"
                        />
                    </template>
                    <template #actions>
                        <eye-outlined @click="openModal(product)" key="view"/>
                        <shopping-cart-outlined key="cart"/>
                    </template>
                    <a-card-meta>
                        <template #title>
                            <Link>
                                <a-typography-text strong class="d-block">{{ product.name }}</a-typography-text>
                            </Link>
                            <a-typography-text delete type="secondary" v-if="product.discount">
                                {{ Intl.NumberFormat().format(product.price) + 'đ' }}
                            </a-typography-text>
                            <a-typography-text strong style="margin-left: 10px">
                                {{ Intl.NumberFormat().format(product.discount ?? product.price) + 'đ' }}
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
import Hero from "../../../Component/Client/Home/Hero.vue";
import {
    SettingOutlined,
    EditOutlined,
    EllipsisOutlined,
    EyeOutlined,
    ShoppingCartOutlined,
    SearchOutlined
} from "@ant-design/icons-vue";
import {Link} from '@inertiajs/inertia-vue3';
import ProductModal from "../../../Component/Client/Home/ProductModal.vue";

export default {
    name: "Index",
    components: {
        ProductModal,
        ClientLayout,
        Hero,
        SettingOutlined,
        EditOutlined,
        EllipsisOutlined,
        EyeOutlined,
        ShoppingCartOutlined,
        SearchOutlined,
        Link
    },
    mounted() {
        this.$refs.layout.setCurrent(["home"]);
        document.title = "Vạn món ngon, bon cả mồm";
    },
    props: {
        products: Array
    },
    methods: {
        openModal(product) {
            this.$refs.modal.visible = true;
            this.$refs.modal.product = product;
        },
    }
}
</script>

<style scoped>
.hero-banner {
    position: relative;
}

.hero-banner img {
    filter: blur(4px);
}

.input-search {
    position: absolute;
    top: 20%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 50%;
    border: none;
    border-radius: 15px;
}
</style>
