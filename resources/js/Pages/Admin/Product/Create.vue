<template>
    <AdminLayout ref="layout">
        <a-typography-title>
            Thêm mới món ăn
        </a-typography-title>
        <div class="row">
            <div class="col-md-6">
                <a-typography-title :level="5">
                    Tên món ăn
                </a-typography-title>
                <a-input v-model:value="form.name" placeholder="Tên sản phẩm"/>
            </div>
            <div class="col-md-6">
                <a-typography-title :level="5">
                    Danh mục
                </a-typography-title>
                <a-select
                    v-model:value="form.category_id"
                    show-search
                    placeholder="Select a category"
                    style="width: 200px"
                    :allowClear="true"
                >
                    <a-select-option v-for="item in categories" :key="item.id" :value="item.id">
                        {{ item.name }}
                    </a-select-option>
                </a-select>
            </div>
            <div class="col-md-6 mt-2">
                <a-typography-title :level="5">
                    Giá món ăn
                </a-typography-title>
                <a-input-number v-model:value="form.price" placeholder="Giá món ăn" class="w-100" :max="999999999" @change="price_change">
                    <template #addonAfter>VNĐ</template>
                </a-input-number>
                <div class="mt-2">
                    {{ price_text }}
                </div>
            </div>
            <div class="col-md-6 mt-2">
                <a-typography-title :level="5">
                    Mô tả
                </a-typography-title>
                <a-textarea v-model:value="form.description" show-count :maxlength="250" rows="3" placeholder="Mô tả"/>
            </div>
            <div class="col-md-6 mt-2">
                <a-typography-title :level="5">
                    Ảnh món ăn
                </a-typography-title>
                <input class="form-control" id="productImage" type="file" @change="uploadImage($event)">
                <img id="preview" src="@/assets/bun-rieu-4.jpg" class="w-100 mt-3"/>
            </div>
        </div>
        <a-button type="primary" shape="round" size="middle" class="mt-3" @click="addProduct">
            <template #icon>
                <plus-outlined/>
            </template>
            Thêm mới
        </a-button>
        <Link :href="route('categories.index')">
            <a-button shape="round" size="middle" class="mt-3 ms-3">
                <template #icon>
                    <rollback-outlined/>
                </template>
                Quay lại
            </a-button>
        </Link>

    </AdminLayout>
</template>

<script>

import AdminLayout from "../../../Layouts/AdminLayout.vue";
import {useForm} from '@inertiajs/inertia-vue3'
import {PlusOutlined, RollbackOutlined, SettingOutlined} from "@ant-design/icons-vue";
import {notification} from "ant-design-vue";
import {Link} from '@inertiajs/inertia-vue3'
import { getText } from 'number-to-text-vietnamese';

export default {
    name: "Create",
    components: {AdminLayout, PlusOutlined, RollbackOutlined, Link, SettingOutlined},
    setup() {
        const form = useForm({
            name: null,
            price: null,
            description: null,
            image: null,
            category_id: null,
        });
        return {
            form
        };
    },
    props: {
        categories: {
            type: Array,
            required: true,
        },
    },
    data() {
        return {
            price_text: ''
        };
    },
    mounted() {
        this.$refs.layout.setSelected(["6"]);
        this.$refs.layout.setBreadItems(["Món ăn", "Thêm mới"]);
        document.title = "Thêm mới món ăn";
    },
    methods: {
        uploadImage(event) {
            let url = URL.createObjectURL(event.target.files[0]);
            $("#preview").attr("src", url);
        },
        addProduct() {
            this.form.image = document.getElementById('productImage').files[0]
            if (this.form.name == null || this.form.price == null || this.form.image == null || this.form.category_id == null) {
                notification.error({
                    message: "Thông báo",
                    description: "Vui lòng nhập đầy đủ thông tin",
                    duration: 2,
                });
                return;
            }
            if (this.form.price < 0) {
                notification.error({
                    message: "Thông báo",
                    description: "Giá món ăn không được nhỏ hơn 0",
                    duration: 2,
                });
                return;
            }
            const validImageTypes = ['image/gif', 'image/jpeg', 'image/png'];
            if (!validImageTypes.includes(this.form.image.type)) {
                notification.error({
                    message: "Thông báo",
                    description: "Vui lòng chọn đúng định dạng ảnh",
                    duration: 2,
                });
                return;
            }
            if (this.form.image.size > 1048576) {
                notification.error({
                    message: "Thông báo",
                    description: "Kích thước ảnh quá lớn",
                    duration: 2,
                });
                return;
            }
            this.form.post(route('products.store'), {})
        },
        price_change() {
            if (this.form.price != undefined || !(isNaN(this.form.price))) {
                this.price_text = getText(this.form.price, ', ');
            } else {
                this.price_text = '';
            }
        }
    }
}
</script>

<style scoped>

</style>
