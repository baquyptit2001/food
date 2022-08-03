<template>
    <div class="d-flex justify-content-center align-items-center" style="min-height: 100vh; background-color: rgba(0,0,0,0.3)">
        <div style="background-color: white; width: 40%;padding: 15px;flex-wrap: wrap;border-radius: 30px">
            <div class="text-center">
                <img src="@/assets/logo.png" style="width: 25%">
            </div>
            <a-typography-title class="text-center w-100">{{ title }}</a-typography-title>
            <slot/>
        </div>
    </div>
</template>

<script>
export default {
    name: "AdminAuthLayout",
    data() {
        return {
            title: 'Auth',
        };
    },
}
</script>

<style scoped>

</style>
