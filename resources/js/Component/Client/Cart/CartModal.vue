<template>
    <a-modal v-model:visible="visible" :title="form.name" @ok="save">
        <div class="row">
            <div class="col-lg-6">
                <img :src="image" style="width: 100%;">
            </div>
            <div class="col-lg-6">
                <a-spin tip="Loading..." :spinning="loading">
                    <a-form-item label="Quantity">
                        <a-input-number v-model:value="form.quantity" :min="1"/>
                    </a-form-item>
                    <a-form-item label="Name">
                        <a-input v-model:value="form.name" disabled style="width: 150px;"/>
                    </a-form-item>
                    <a-form-item label="Quantity">
                        <a-input-number v-model:value="form.price" disabled/>
                    </a-form-item>
                </a-spin>
            </div>
        </div>
    </a-modal>
</template>

<script>
import {useForm, Link} from '@inertiajs/inertia-vue3';
import {notification} from "ant-design-vue";

export default {
    name: "CartModal",
    components: {Link},
    data() {
        return {
            visible: false,
            loading: false,
            image: null,
        }
    },
    setup() {
        const form = useForm({
            quantity: 1,
            id: null,
            name: null,
            price: null,
        })

        return {
            form,
        }
    },
    methods: {
        save() {
            this.loading = true;
            this.form.put(route('client.carts.update', this.form.id), {
                onSuccess: () => {
                    notification.success({
                        message: 'Success',
                        description: 'Update cart successfully',
                    });
                },
                onError: () => {
                    notification.error({
                        message: 'Error',
                        description: 'Update cart failed',
                    });
                },
                onFinish: () => {
                    this.loading = false;
                    this.visible = false;
                }
            })
        }
    },
}
</script>

<style scoped>

</style>
