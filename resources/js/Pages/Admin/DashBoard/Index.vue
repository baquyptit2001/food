<template>
    <AdminLayout ref="layout">
        Hello, {{ $page.props.user.data.name }}
    </AdminLayout>
</template>

<script>

import AdminLayout from "../../../Layouts/AdminLayout.vue";

export default {
    name: "Index",
    components: {AdminLayout},
    data() {
        return {
            collapsed: false,
        };
    },
    mounted() {
        this.$refs.layout.setSelected(["1"]);
        this.$refs.layout.setBreadItems(["Dashboard"]);
        document.title = "Dashboard";
    }

}
</script>

<style scoped>

</style>
