<template>
    <AdminLayout ref="layout">

    </AdminLayout>
</template>

<script>
import AdminLayout from "../../../Layouts/AdminLayout.vue";
export default {
    name: "Index",
    components: {AdminLayout},
    props: {
        products: Array
    },
    mounted() {
        this.$refs.layout.setSelected(["5"]);
        this.$refs.layout.setBreadItems(["Food", "List"])
        document.title = "Danh sách món ăn"
    },
}
</script>

<style scoped>

</style>
