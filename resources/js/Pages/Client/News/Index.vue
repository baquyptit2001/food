<template>
    <ClientLayout ref="layout">
        <div class="row mt-5" v-if="news.data.length">
            <div class="col-lg-8 col-md-6 shadow">
                <Link :href="route('client.news.show', news.data[0].slug)">
                    <a-card hoverable style="width: 100%">
                        <template #cover>
                            <img alt="example" :src="news.data[0].image" style="width: 100%"/>
                        </template>
                        <a-card-meta :title="news.data[0].title">
                            <template #description>
                                {{ news.data[0].description }}
                                <div style="display: flex; align-items: center">
                                    <clock-circle-outlined style="margin-right: 5px"/>
                                    <a-typography-text>
                                        {{ news.data[0].created_at }}
                                    </a-typography-text>
                                </div>
                            </template>
                        </a-card-meta>
                    </a-card>
                </Link>
            </div>
            <div class="col-lg-4 col-md-6 shadow" v-for="newss in news.data.slice(1)" style="min-height: 100%">
                <Link :href="route('client.news.show', newss.slug)">
                    <a-card hoverable style="width: 100%; height: 100%">
                        <template #cover>
                            <img alt="example" :src="newss.image" style="width: 100%"/>
                        </template>
                        <a-card-meta :title="newss.title">
                            <template #description>
                                {{ newss.description }}
                                <div style="display:flex; align-items: center">
                                    <clock-circle-outlined style="margin-right: 5px"/>
                                    <a-typography-text>
                                        {{ newss.created_at }}
                                    </a-typography-text>
                                </div>
                            </template>
                        </a-card-meta>
                    </a-card>
                </Link>
            </div>
        </div>
        <a-typography-title v-else class="comming-soon">Coming Soon !</a-typography-title>
    </ClientLayout>
</template>

<script>
import ClientLayout from "../../../Layouts/ClientLayout.vue";
import {ClockCircleOutlined} from "@ant-design/icons-vue";
import {Link} from "@inertiajs/inertia-vue3";

export default {
    name: "Index",
    components: {ClientLayout, ClockCircleOutlined, Link},
    mounted() {
        this.$refs.layout.setCurrent(["page:2"]);
        document.title = "Danh s??ch ??u ????i";
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
    font-family: 'DynaPuff', serif;
    -webkit-touch-callout: none;
    -webkit-user-select: none;
    -khtml-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
}
</style>
