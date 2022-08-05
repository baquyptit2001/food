<template>
    <AdminLayout ref="layout">
        <a-descriptions title="Thông tin cá nhân" bordered>
            <a-descriptions-item label="Tên hiển thị">
                {{ user.data.name }}
            </a-descriptions-item>
            <a-descriptions-item label="Email">
                {{ user.data.email }}
            </a-descriptions-item>
            <a-descriptions-item label="Vị trí">
                <a-tag :color="tagColor[0][user.data.role.name]">{{ user.data.role.name }}</a-tag>
            </a-descriptions-item>
            <a-descriptions-item label="Trạng thái">
                <a-badge :status="user.data.is_active ? 'success' : 'error'" :text="user.data.status"/>
            </a-descriptions-item>
        </a-descriptions>
    </AdminLayout>
</template>

<script>

import AdminLayout from "../../../Layouts/AdminLayout.vue";

export default {
    name: "Profile",
    components: {AdminLayout},
    props: {
        user: Object
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
