<template>
    <AdminLayout ref="layout">
        <a-typography-title>
            Thêm mới bài viết
        </a-typography-title>
        <div class="row">
            <div class="col-md-6">
                <a-typography-title :level="5">
                    Tiêu đề
                </a-typography-title>
                <a-input v-model:value="form.title" placeholder="Tiêu đề bài viết"/>
            </div>
            <div class="col-md-6">
                <a-typography-title :level="5">
                    Mô tả
                </a-typography-title>
                <a-textarea v-model:value="form.description" show-count :maxlength="250" rows="3" placeholder="Mô tả"/>
            </div>
            <div class="col-md-6 mt-2">
                <a-typography-title :level="5">
                    Ảnh bìa
                </a-typography-title>
                <input class="form-control" id="thumbnail" type="file" @change="uploadImage($event)"
                       accept="image/png, image/gif, image/jpeg">
                <img id="preview" :src="news.data.image" class="w-100 mt-3"/>
            </div>
        </div>
        <a-button type="primary" shape="round" size="middle" class="mt-3" @click="addNews" :loading="loading">
            <template #icon>
                <setting-outlined/>
            </template>
            Cập nhật
        </a-button>
        <Link :href="route('admin.news.index')">
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
import {RollbackOutlined, PlusOutlined, SettingOutlined} from "@ant-design/icons-vue";
import {Link} from '@inertiajs/inertia-vue3'
import {useForm} from '@inertiajs/inertia-vue3'
import {notification} from "ant-design-vue";
import {getErrorMessage} from "../../../Helper/stringHelper";

export default {
    name: "Edit",
    components: {AdminLayout, PlusOutlined, RollbackOutlined, Link, SettingOutlined},
    mounted() {
        this.$refs.layout.setBreadItems(["News", "Create"]);
        this.$refs.layout.setSelected(["13"]);
        this.form.title = this.news.data.title;
        this.form.description = this.news.data.description;
        document.title = this.news.data.title;
    },
    data() {
        return {
            loading: false,
            imageChanged: false,
        };
    },
    props: {
        news: Object,
    },
    setup() {
        const form = useForm({
            title: '',
            description: '',
            image: '',
        });

        return {
            form
        }
    },
    methods: {
        uploadImage(event) {
            let url = URL.createObjectURL(event.target.files[0]);
            $("#preview").attr("src", url);
            this.imageChanged = true;
        },
        addNews() {
            this.loading = true;
            if (this.imageChanged) {
                this.form.image = document.getElementById('thumbnail').files[0];
            }
            this.form.description = this.form.description.replace(/\n/g, '<br>');
            this.form.post(route('admin.news.update', this.news.data.slug), {
                onSuccess: (data) => {
                    notification.success({
                        message: 'Cập nhật thành công',
                        description: 'Bài viết đã được cập nhật thành công',
                    });
                },
                onError: (data) => {
                    console.log(data);
                    notification.error({
                        message: 'Cập nhật thất bại',
                        description: getErrorMessage(data),
                    });
                },
                onFinish: () => {
                    this.loading = false
                }
            });
        }
    }
}
</script>

<style scoped>

</style>
