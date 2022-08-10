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
                <apple-filled />
            </template>
            <template #title>Danh mục</template>
            <a-menu-item-group v-for="category in $page.props.categories" :title="category.name">
                <a-menu-item v-for="child in category.children" :key="'category:' + child.id">{{ child.name }}</a-menu-item>
            </a-menu-item-group>
        </a-sub-menu>
        <a-sub-menu key="page">
            <template #icon>
                <desktop-outlined />
            </template>
            <template #title>Trang</template>
            <a-menu-item key="setting:1">Đặt món</a-menu-item>
            <a-menu-item key="setting:2">Ưu đãi</a-menu-item>
            <a-menu-item key="setting:3">Liên lạc</a-menu-item>
            <a-menu-item key="setting:4">Địa chỉ</a-menu-item>
        </a-sub-menu>
        <a-sub-menu key="social">
            <template #icon>
                <global-outlined />
            </template>
            <template #title>MXH</template>
            <a-menu-item key="setting:1">Facebook</a-menu-item>
            <a-menu-item key="setting:2">Instagram</a-menu-item>
            <a-menu-item key="setting:3">TikTok</a-menu-item>
            <a-menu-item key="setting:4">YouTube</a-menu-item>
        </a-sub-menu>
        <a-menu-item disabled style="cursor: default; margin-left: auto">
            <a-input placeholder="Search" />
        </a-menu-item>
    </a-menu>
    <div class="container">
        <slot/>
    </div>
</template>
<script>
import {defineComponent, ref} from 'vue';
import {MailOutlined, AppstoreOutlined, DesktopOutlined, HomeOutlined, AppleFilled, GlobalOutlined} from '@ant-design/icons-vue';
import {Link} from '@inertiajs/inertia-vue3'

export default defineComponent({
    components: {
        MailOutlined,
        AppstoreOutlined,
        DesktopOutlined,
        HomeOutlined,
        AppleFilled,
        GlobalOutlined,
        Link
    },

    setup() {
        const current = ref(['home']);
        return {
            current,
        };
    },

    methods: {
        setCurrent(key) {
            this.current = key;
        }
    },

});
</script>
