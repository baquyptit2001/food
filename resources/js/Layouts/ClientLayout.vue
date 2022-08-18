<template>
    <Header :current="current"/>
    <div class="container">
        <slot/>
    </div>
    <Footer/>
</template>
<script>
import {ref} from 'vue';
import Header from "../Component/Client/ClientLayout/Header.vue";
import Footer from "../Component/Client/ClientLayout/Footer.vue";

export default {
    components: {Header, Footer},
    setup() {
        const current = ref(['home']);
        return {
            current,
        };
    },
    methods: {
        setCurrent(key) {
            this.current = key;
        }
    },
};
</script>

<style>
a {
    color: inherit;
}
</style>
