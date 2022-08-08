<template>
    <AdminLayout ref="layout">
        <a-descriptions title="Thông tin cá nhân" bordered>
            <a-descriptions-item label="Tên hiển thị">
                {{ userProfile.data.name }}
            </a-descriptions-item>
            <a-descriptions-item label="Email">
                {{ userProfile.data.email }}
            </a-descriptions-item>
            <a-descriptions-item label="Vị trí">
                <a-tag :color="tagColor[0][userProfile.data.role.name]">{{ userProfile.data.role.name }}</a-tag>
            </a-descriptions-item>
            <a-descriptions-item label="Trạng thái">
                <a-badge :status="userProfile.data.is_active ? 'success' : 'error'" :text="userProfile.data.status"/>
            </a-descriptions-item>
        </a-descriptions>
        <Link v-if="$page.props.user.data.id === userProfile.data.id" :href="route('admin.users.update-page')">
            <a-button class="mt-5" type="primary" shape="round" size="large">
                <template #icon>
                    <edit-outlined/>
                </template>
                Update
            </a-button>
        </Link>

    </AdminLayout>
</template>

<script>

import AdminLayout from "../../../Layouts/AdminLayout.vue";
import {EditOutlined} from "@ant-design/icons-vue";
import {Link} from '@inertiajs/inertia-vue3'

export default {
    name: "Profile",
    components: {AdminLayout, EditOutlined, Link},
    props: {
        userProfile: Object
    },
    setup() {
        const tagColor = [{
            'ADMIN': "pink",
            "MODERATOR": "blue",
            "USER": "green"
        }]

        return {
            tagColor
        }
    },
    mounted() {
        this.$refs.layout.setSelected(["7"]);
        this.$refs.layout.setBreadItems(["User", "Profile"])
        document.title = "Thông tin cá nhân"

    },
}
</script>

<style scoped>

</style>
