<template>
    <a-modal v-model:visible="visible" width="1000px" :title="product.name" @ok="handleOk">
        <template #footer>
            <a-button key="close" @click="handleClose">Close</a-button>
        </template>
        <div class="row">
            <div class="col-lg-6">
                <img :src="product.image" style="width: 100%"/>
            </div>
            <div class="col-lg-6">
                <a-typography-text strong style="font-size: 30px">
                    {{ product.name }}
                </a-typography-text>
                <div style="font-size: 20px">
                    {{ product.description }}
                </div>
                <div>
                    <a-typography-text style="font-size: 24px" delete type="secondary" v-if="product.discount">
                        {{ Intl.NumberFormat().format(product.price) + 'đ' }}
                    </a-typography-text>
                    <a-typography-text strong style="margin-left: 10px; font-size: 28px">
                        {{ Intl.NumberFormat().format(product.discount ?? product.price) + 'đ' }}
                    </a-typography-text>
                </div>
                <a-input-number v-model:value="form.quantity" :keyboard="true" :min="1" class="mt-3"/>
                <div class="mt-3">
                    <a-button type="primary" @click="addToCart" shape="round">
                        <ShoppingCartOutlined />
                        Add to cart
                    </a-button>
                </div>
            </div>
        </div>
    </a-modal>
</template>

<script>
import {useForm} from "@inertiajs/inertia-vue3";
import {ShoppingCartOutlined} from "@ant-design/icons-vue";

export default {
    name: "ProductModal",
    components: {
        ShoppingCartOutlined
    },
    data() {
        return {
            visible: false,
            product: {},
        };
    },
    setup() {
        const form = useForm({
            quantity: 1,
            slug: "",
        })

        return {
            form,
        };
    },
    methods: {
        handleOk(e) {
            console.log(e)
            this.visible = false;
        },
        handleClose() {
            this.visible = false;
        },
        addToCart() {

        }
    },
}
</script>

<style scoped>
input {
    text-align: center;
}
</style>
