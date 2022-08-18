<template>
    <a-menu v-model:selectedKeys="current" mode="horizontal">
        <Link :href="route('client.home')">
            <a-menu-item key="logo" disabled style="cursor: pointer">
                <img src="@/assets/logo.png" style="width: 50px">
            </a-menu-item>
        </Link>
        <a-menu-item key="home">
            <Link :href="route('client.home')">
                Home
            </Link>
        </a-menu-item>
        <a-menu-item key="app">
            <template #icon>
                <appstore-outlined/>
            </template>
            Menu
        </a-menu-item>
        <a-sub-menu key="category">
            <template #icon>
                <apple-filled/>
            </template>
            <template #title>Danh mục</template>
            <a-menu-item-group v-for="category in $page.props.categories" :title="category.name">
                <a-menu-item v-for="child in category.children" :key="'category:' + child.id">{{
                        child.name
                    }}
                </a-menu-item>
            </a-menu-item-group>
        </a-sub-menu>
        <a-sub-menu key="page">
            <template #icon>
                <desktop-outlined/>
            </template>
            <template #title>Trang</template>
            <a-menu-item key="page:1">Đặt món</a-menu-item>
            <a-menu-item key="page:2">
                <Link :href="route('client.news.index')">Ưu đãi</Link>
            </a-menu-item>
            <a-menu-item key="page:3">Liên lạc</a-menu-item>
            <a-menu-item key="page:4">Địa chỉ</a-menu-item>
        </a-sub-menu>
        <a-sub-menu key="social">
            <template #icon>
                <global-outlined/>
            </template>
            <template #title>MXH</template>
            <a-menu-item key="social:1">Facebook</a-menu-item>
            <a-menu-item key="social:2">Instagram</a-menu-item>
            <a-menu-item key="social:3">TikTok</a-menu-item>
            <a-menu-item key="social:4">YouTube</a-menu-item>
        </a-sub-menu>
        <a-menu-item class="hihi" style="cursor: default; margin-left: auto; padding-top: 5px">
            <a-input placeholder="Search"/>
            <!--                        <a-badge count="5" style="margin-left: 10px">-->
            <!--                            <Link>-->
            <!--                                <a-button type="link" size="small">-->
            <!--                                    <shopping-cart-outlined style="font-size: 30px; cursor:pointer;color: black"/>-->
            <!--                                </a-button>-->
            <!--                            </Link>-->
            <!--                        </a-badge>-->
        </a-menu-item>
        <a-sub-menu key="info" v-if="$page.props.user.data.id">
            <template #title>Hello, {{ $page.props.user.data.name }}</template>
            <a-menu-item key="info:1">Profile</a-menu-item>
            <a-menu-item key="info:2">Giỏ hàng</a-menu-item>
<!--            <a-divider/>-->
            <a-menu-item key="info:3">
                <Link :href="route('client.auth.logout')">
                    Đăng xuất
                </Link>
            </a-menu-item>
        </a-sub-menu>
        <a-menu-item key="login" v-else>
            <Link :href="route('client.auth.login.page')">
                <qq-outlined/>
                Đăng nhập
            </Link>
        </a-menu-item>
    </a-menu>
</template>

<script>

import {
    MailOutlined,
    AppstoreOutlined,
    DesktopOutlined,
    HomeOutlined,
    AppleFilled,
    ShoppingCartOutlined,
    QqOutlined,
    GlobalOutlined
} from '@ant-design/icons-vue';
import {Link} from '@inertiajs/inertia-vue3'

export default {
    name: "Header",
    components: {
        MailOutlined,
        AppstoreOutlined,
        DesktopOutlined,
        HomeOutlined,
        AppleFilled,
        ShoppingCartOutlined,
        GlobalOutlined,
        QqOutlined,
        Link
    },
    mounted() {

    },
    props: {
        current: {
            type: String,
            default: 'home'
        }
    },
}
</script>

<style scoped>
</style>
