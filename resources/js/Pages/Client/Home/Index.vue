<template>
    <ClientLayout ref="layout">
        <Hero/>
        <div class="banner">
            <img src="@/assets/hero/banner.jpg" style="margin-top: 15px; width: 100%">
        </div>
    </ClientLayout>
</template>

<script>
import ClientLayout from "../../../Layouts/ClientLayout.vue";
import Hero from "../../../Component/Client/Home/Hero.vue";

export default {
    name: "Index",
    components: {ClientLayout, Hero},
    mounted() {
        this.$refs.layout.setCurrent(["home"]);
    }
}
</script>

<style scoped>
</style>
