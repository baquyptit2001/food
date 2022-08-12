<template>
    <AdminLayout ref="layout">
        <div class="d-flex justify-content-between" id="test">
            <a-typography-title>
                Danh sách bài viết
            </a-typography-title>
            <Link :href="route('admin.news.create')">
                <a-button class="me-3">
                    <template #icon>
                        <plus-outlined/>
                    </template>
                    Thêm bài viết
                </a-button>
            </Link>
        </div>
        <a-table :columns="columns" :data-source="news.data" v-if="news.data">
            <template #bodyCell="{ column, text, record }">
                <template v-if="column.key === 'action'">
                    <Link :href="route('admin.news.edit', record.slug)">
                        <a-button type="primary" class="me-3">Sửa</a-button>
                    </Link>
                    <a-popconfirm
                        title="Bạn có thật sự muốn xóa bài viết này?"
                        ok-text="Xóa"
                        cancel-text="Hủy"
                        @confirm="deletePost(record.slug)"
                    >
                        <a-button type="danger">Xóa</a-button>
                    </a-popconfirm>
                </template>
                <template v-if="column.key === 'thumbnail'">
                    <img :src="record.image" style="width: 300px"/>
                </template>
            </template>
        </a-table>
        <a-skeleton active v-else/>
    </AdminLayout>
</template>

<script>
import AdminLayout from "../../../Layouts/AdminLayout.vue";
import {PlusOutlined} from "@ant-design/icons-vue";
import {Link} from '@inertiajs/inertia-vue3'
import {notification} from "ant-design-vue";
import {getErrorMessage} from "../../../Helper/stringHelper";

export default {
    name: "Index",
    components: {AdminLayout, PlusOutlined, Link},
    mounted() {
        this.$refs.layout.setBreadItems(["News", "List"]);
        this.$refs.layout.setSelected(["12"]);
        document.title = "Danh sách bài viết";
    },
    setup() {
        const columns = [{
            title: 'ID',
            dataIndex: 'id',
            key: 'id',
            sorter: true
        }, {
            title: 'Thumbnail',
            key: 'thumbnail',
        }, {
            title: 'Title',
            dataIndex: 'title',
            key: 'title'
        }, {
            title: 'Description',
            dataIndex: 'description',
            key: 'description'
        }, {
            title: 'Actions',
            key: 'action'
        }]
        return {columns}
    },
    props: {
        news: Array
    },
    methods: {
        deletePost(slug) {
            this.$inertia.delete(route('admin.news.destroy', slug), {
                onSuccess: () => {
                    notification.success({
                        message: 'Success',
                        description: 'Bài viết đã được xóa'
                    });
                },
                onError: (error) => {
                    notification.error({
                        message: 'Error',
                        description: getErrorMessage(error)
                    });
                }
            })
        }
    }

}
</script>

<style scoped>

</style>
