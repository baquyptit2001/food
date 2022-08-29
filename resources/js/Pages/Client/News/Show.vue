<template>
    <ClientLayout ref="layout">
        <a-page-header
            style="border: 1px solid rgb(235, 237, 240); margin: 15px 0;"
            :title="news.data.title"
            :sub-title="news.data.created_at"
            @back="back"
        />
        <div class="text-center">
            <img :src="news.data.image" style="width: 70%"/>
        </div>
        <a-typography-text>
            {{ news.data.description }}
        </a-typography-text>
    </ClientLayout>
</template>

<script>
import ClientLayout from "../../../Layouts/ClientLayout.vue";

export default {
    name: "Show",
    components: {ClientLayout},
    mounted() {
        this.$refs.layout.setCurrent(["page:2"]);
        document.title = this.news.data.title;
    },
    props: {
        news: Array
    },
    methods: {
        back() {
            window.location.replace(this.route("client.news.index"));
        }
    }
}
</script>

<style scoped>

</style>
