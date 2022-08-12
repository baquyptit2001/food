<template>
    <a-layout style="min-height: 100vh">
        <a-layout-sider v-model:collapsed="collapsed" collapsible :onCollapse="(value) => sideCollapsed(value)">
            <div class="logo"/>
            <a-menu v-model:selectedKeys="selectedKeys" theme="dark" mode="inline">
                <a-menu-item key="1">
                    <Link :href="route('admin.dashboard')">
                        <home-outlined/>
                        <span>Home</span>
                    </Link>
                </a-menu-item>
                <a-sub-menu key="sub1">
                    <template #title>
                        <span>
                          <folder-outlined/>
                          <span>Category</span>
                        </span>
                    </template>
                    <Link :href="route('admin.categories.index')">
                        <a-menu-item key="3">List</a-menu-item>
                    </Link>
                    <Link :href="route('admin.categories.create')">
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
                    <Link :href="route('admin.products.index')">
                        <a-menu-item key="5">List</a-menu-item>
                    </Link>
                    <Link :href="route('admin.products.create')">
                        <a-menu-item key="6">Create</a-menu-item>
                    </Link>
                </a-sub-menu>
                <a-sub-menu key="sub3">
                    <template #title>
                        <span>
                          <safety-certificate-outlined />
                          <span>Role</span>
                        </span>
                    </template>
                    <Link :href="route('admin.roles.index')">
                        <a-menu-item key="9">List</a-menu-item>
                    </Link>
                    <Link :href="route('admin.roles.create')">
                        <a-menu-item key="10">Create</a-menu-item>
                    </Link>
                </a-sub-menu>
                <a-sub-menu key="sub6">
                    <template #title>
                        <span>
                          <percentage-outlined />
                          <span>Promotion</span>
                        </span>
                    </template>
                    <Link :href="route('admin.promotions.index')">
                        <a-menu-item key="14">List</a-menu-item>
                    </Link>
                    <Link :href="route('admin.promotions.create')">
                        <a-menu-item key="15">Create</a-menu-item>
                    </Link>
                </a-sub-menu>
                <a-sub-menu key="sub5">
                    <template #title>
                        <span>
                          <container-outlined />
                          <span>News</span>
                        </span>
                    </template>
                    <Link :href="route('admin.news.index')">
                        <a-menu-item key="12">List</a-menu-item>
                    </Link>
                    <Link :href="route('admin.news.create')">
                        <a-menu-item key="13">Create</a-menu-item>
                    </Link>
                </a-sub-menu>
                <a-sub-menu key="sub4">
                    <template #title>
                        <span>
                          <user-outlined />
                          <span>Account</span>
                        </span>
                    </template>
                    <Link :href="route('admin.users.profile', $page.props.user.data.id)">
                        <a-menu-item key="7">Profile</a-menu-item>
                    </Link>
                    <Link :href="route('admin.users.index')">
                        <a-menu-item key="11">List</a-menu-item>
                    </Link>
                    <Link :href="route('admin.auth.logout')">
                        <a-menu-item key="8">Logout</a-menu-item>
                    </Link>
                </a-sub-menu>
            </a-menu>
        </a-layout-sider>
        <a-layout>
            <a-layout-header style="background: #fff; padding: 0 15px">
                <Link :href="route('admin.dashboard')">NBQ Food</Link>
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
    FolderOutlined,
    ContainerOutlined,
    PercentageOutlined,
    SafetyCertificateOutlined,
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
        ContainerOutlined,
        PercentageOutlined,
        SafetyCertificateOutlined,
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
    mounted() {
        this.setCollapsed();
    },
    methods: {
        setSelected(selectedKeys: string[]) {
            this.selectedKeys = selectedKeys;
        },
        setBreadItems(breadItems: string[]) {
            this.breadItems = breadItems;
        },
        setCollapsed() {
            this.collapsed = this.$store.getters.isCollapsed
        },
        sideCollapsed(value) {
            this.$store.commit('toggleSidebar');
            this.setCollapsed();
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
