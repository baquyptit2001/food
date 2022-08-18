<template>
    <ClientLayout ref="layout">
        <div class="row mt-5" v-if="news.data.length">
            <div class="col-lg-8 col-md-6 shadow">
                <a-card hoverable style="width: 100%">
                    <template #cover>
                        <img alt="example" :src="news.data[0].image" style="width: 100%"/>
                    </template>
                    <a-card-meta :title="news.data[0].title">
                        <template #description>{{ news.data[0].description }}</template>
                    </a-card-meta>
                </a-card>
            </div>
            <div class="col-lg-4 col-md-6 shadow" v-for="newss in news.data.slice(1)" style="min-height: 100%">
                <a-card hoverable style="width: 100%; height: 100%">
                    <template #cover>
                        <img alt="example" :src="newss.image" style="width: 100%"/>
                    </template>
                    <a-card-meta :title="newss.title">
                        <template #description>{{ newss.description }}</template>
                    </a-card-meta>
                </a-card>
            </div>
        </div>
        <a-typography-title v-else class="comming-soon">Coming Soon !</a-typography-title>
    </ClientLayout>
</template>

<script>
import ClientLayout from "../../../Layouts/ClientLayout.vue";

export default {
    name: "Index",
    components: {ClientLayout},
    mounted() {
        this.$refs.layout.setCurrent(["page:2"]);
    },
    props: {
        news: Array
    },
}
</script>

<style scoped>
.comming-soon {
    text-align: center;
    font-size: 500%;
    font-weight: bold;
    height: 80vh;
    line-height: 80vh;
    vertical-align: center;
    font-family: 'DynaPuff',serif;
    -webkit-touch-callout: none;
    -webkit-user-select: none;
    -khtml-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
}
</style>
