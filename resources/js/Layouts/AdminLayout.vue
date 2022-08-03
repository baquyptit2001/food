<template>
    <a-layout style="min-height: 100vh">
        <a-layout-sider v-model:collapsed="collapsed" collapsible>
            <div class="logo"/>
            <a-menu v-model:selectedKeys="selectedKeys" theme="dark" mode="inline">
                <a-menu-item key="1">
                    <Link :href="route('dashboard')">
                        <home-outlined/>
                        <span>Home</span>
                    </Link>
                </a-menu-item>
                <a-menu-item key="2">
                    <desktop-outlined/>
                    <span>Option 2</span>
                </a-menu-item>
                <a-sub-menu key="sub1">
                    <template #title>
                        <span>
                          <folder-outlined/>
                          <span>Category</span>
                        </span>
                    </template>
                    <Link :href="route('categories.index')">
                        <a-menu-item key="3">List</a-menu-item>
                    </Link>
                    <Link :href="route('categories.create')">
                        <a-menu-item key="4">Create</a-menu-item>
                    </Link>
                </a-sub-menu>
                <a-sub-menu key="sub2">
                    <template #title>
                        <span>
                          <apple-outlined/>
                          <span>Food</span>
                        </span>
                    </template>
                    <Link :href="route('products.index')">
                        <a-menu-item key="5">List</a-menu-item>
                    </Link>
                    <Link :href="route('products.create')">
                        <a-menu-item key="6">Create</a-menu-item>
                    </Link>
                </a-sub-menu>
                <a-sub-menu key="sub3">
                    <template #title>
                        <span>
                          <user-outlined />
                          <span>Account</span>
                        </span>
                    </template>
                    <Link :href="route('categories.index')">
                        <a-menu-item key="7">Profile</a-menu-item>
                    </Link>
                    <Link :href="route('auth.logout')">
                        <a-menu-item key="8">Logout</a-menu-item>
                    </Link>
                </a-sub-menu>
            </a-menu>
        </a-layout-sider>
        <a-layout>
            <a-layout-header style="background: #fff; padding: 0 15px">
                <Link :href="route('dashboard')">NBQ Food</Link>
            </a-layout-header>
            <a-layout-content style="margin: 0 16px">
                <a-breadcrumb style="margin: 16px 0">
                    <a-breadcrumb-item v-for="item of breadItems">{{ item }}</a-breadcrumb-item>
                </a-breadcrumb>
                <div :style="{ padding: '24px', background: '#fff', minHeight: '360px' }">
                    <slot/>
                </div>
            </a-layout-content>
            <a-layout-footer style="text-align: center">
                Ant Design ©2018 Created by Ant UED
            </a-layout-footer>
        </a-layout>
    </a-layout>
</template>
<script lang="ts">
import {
    PieChartOutlined,
    DesktopOutlined,
    UserOutlined,
    TeamOutlined,
    FileOutlined,
    HomeOutlined,
    AppleOutlined,
    FolderOutlined
} from '@ant-design/icons-vue';
import {defineComponent, ref} from 'vue';
import {Link} from "@inertiajs/inertia-vue3";

export default defineComponent({
    components: {
        PieChartOutlined,
        DesktopOutlined,
        UserOutlined,
        TeamOutlined,
        FileOutlined,
        HomeOutlined,
        FolderOutlined,
        AppleOutlined,
        Link
    },
    name: 'AdminLayout',
    data() {
        return {
            collapsed: ref<boolean>(false),
            selectedKeys: ref<string[]>(['1']),
            breadItems: ref<string[]>(['Dashboard']),
        };
    },
    methods: {
        setSelected(selectedKeys: string[]) {
            this.selectedKeys = selectedKeys;
        },
        setBreadItems(breadItems: string[]) {
            this.breadItems = breadItems;
        }
    },
});
</script>
<style>
#components-layout-demo-side .logo {
    height: 32px;
    margin: 16px;
    background: rgba(255, 255, 255, 0.3);
}

.site-layout .site-layout-background {
    background: #fff;
}

[data-theme='dark'] .site-layout .site-layout-background {
    background: #141414;
}
</style>
