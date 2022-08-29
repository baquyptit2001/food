<template>
    <div class="hero-banner">
        <img src="@/assets/hero/herobanner.jpg" class="herobanner" style="margin-top: 15px; width: 100%"/>
        <a-input allowClear placeholder="Search" class="input-search shadow" @change="search" v-model:value="form.search">
            <template #prefix>
                <search-outlined/>
            </template>
        </a-input>
        <div class="search-result" v-if="searchNews.length || searchProduct.length">
            <a-typography-paragraph>
                <div v-if="searchProduct.length">
                    <pre>Product</pre>
                    <div class="row" style="padding: 5px 15px" v-for="product in searchProduct">
                            <div class="col-4">
                                <img :src="product.image" style="width: 100%;" alt="product-image">
                            </div>
                            <div class="col-8">
                                <a-typography-title style="font-size: 20px">{{ product.name }}</a-typography-title>
                                <a-typography-text>
                                    {{ product.description }}
                                </a-typography-text>
                            </div>
                    </div>
                </div>
                <div v-if="searchNews.length">
                    <pre>News</pre>
                    <div class="row" style="padding: 5px 15px" v-for="news in searchNews">
                        <div class="col-4">
                            <img :src="news.image" style="width: 100%;" alt="news-thumbnail">
                        </div>
                        <div class="col-8">
                            <Link :href="route('client.news.show', news.slug)"><a-typography-title style="font-size: 20px">{{ news.title }}</a-typography-title></Link>
                            <a-typography-text>
                                {{ news.description }}
                            </a-typography-text>
                        </div>
                    </div>
                </div>
            </a-typography-paragraph>
        </div>
    </div>
</template>

<script>
import {Link, useForm} from '@inertiajs/inertia-vue3';
import {SearchOutlined} from '@ant-design/icons-vue';

export default {
    name: "Search",
    components: {
        Link,
        SearchOutlined
    },
    setup() {
        const form = useForm({
            search: ''
        });

        return {
            form,
        }
    },
    data() {
        return {
            searchNews: [],
            searchProduct: []
        }
    },
    methods: {
        search() {
            if (this.form.search.length > 0) {
                axios.get(this.route('search', this.form.search)).then(res => {
                    this.searchProduct = res.data.products;
                    this.searchNews = res.data.news;
                }).catch(err => {
                    console.log(err);
                });
            } else {
                this.searchProduct = [];
                this.searchNews = [];
            }
        }
    }
}
</script>

<style scoped>
.hero-banner {
    position: relative;
}

.hero-banner .herobanner {
    filter: blur(4px);
}

.input-search {
    position: absolute;
    top: 20%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 50%;
    border: none;
    border-radius: 15px;
}
.search-result {
    position: absolute;
    top: 48%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 50%;
    height: 300px;
    border: none;
    border-radius: 15px;
    background: white;
    overflow-y: scroll;
    overflow-x: hidden;
}
</style>
