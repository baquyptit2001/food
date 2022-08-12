<template>
    <ClientLayout ref="layout">
        <Hero/>
        <div class="banner">
            <img src="@/assets/hero/banner.jpg" style="margin-top: 15px; width: 100%">
        </div>
        <a-page-header
            style="border: 1px solid rgb(235, 237, 240); margin-top: 15px"
            title="Hot"
            sub-title="Món bán chạy nhất"
        />
        <div class="row mt-3 justify-content-around">
            <div class="col-lg-3 col-md-6" v-for="i in [1,2,3,4]">
                <Link>
                    <a-card hoverable style="width: 300px">
                        <template #cover>
                            <img
                                alt="example"
                                src="https://cdn.tgdd.vn/Files/2017/03/18/962092/an-lien-3-bat-pho-voi-cong-thuc-nau-pho-nay-202201261419401397.jpg"
                            />
                        </template>
                        <template #actions>
                            <eye-outlined key="view"/>
                            <shopping-cart-outlined key="cart"/>
                        </template>
                        <a-card-meta title="Phở" description="Ngon vãi loz"/>
                    </a-card>
                </Link>
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
    ShoppingCartOutlined
} from "@ant-design/icons-vue";
import {Link} from '@inertiajs/inertia-vue3';

export default {
    name: "Index",
    components: {
        ClientLayout,
        Hero,
        SettingOutlined,
        EditOutlined,
        EllipsisOutlined,
        EyeOutlined,
        ShoppingCartOutlined,
        Link
    },
    mounted() {
        this.$refs.layout.setCurrent(["home"]);
        document.title = "Vạn món ngon, bon cả mồm";
    }
}
</script>

<style scoped>
</style>
