<template>
    <a-carousel arrows :autoplay="true" effect="fade">
        <template #prevArrow>
            <div class="custom-slick-arrow" style="left: 10px; z-index: 1">
                <left-circle-outlined/>
            </div>
        </template>
        <template #nextArrow>
            <div class="custom-slick-arrow" style="right: 10px">
                <right-circle-outlined/>
            </div>
        </template>
        <div><img src="@/assets/hero/1.jpg"></div>
        <div><img src="@/assets/hero/2.jpg"></div>
        <div><img src="@/assets/hero/3.jpg"></div>
        <div><img src="@/assets/hero/4.jpg"></div>
    </a-carousel>
</template>

<script>

import {LeftCircleOutlined, RightCircleOutlined} from "@ant-design/icons-vue";

export default {
    name: "Hero",
    components: {LeftCircleOutlined, RightCircleOutlined},
}
</script>

<style scoped>
img {
    width: 100%;
}

.ant-carousel :deep(.slick-slide) {
    text-align: center;
    background: #364d79;
    overflow: hidden;
}

.ant-carousel :deep(.slick-arrow.custom-slick-arrow) {
    width: 25px;
    height: 25px;
    font-size: 25px;
    color: #fff;
    background-color: rgba(31, 45, 61, 0.11);
    opacity: 0.3;
    z-index: 1;
}

.ant-carousel :deep(.custom-slick-arrow:before) {
    display: none;
}

.ant-carousel :deep(.custom-slick-arrow:hover) {
    opacity: 0.5;
}
</style>
