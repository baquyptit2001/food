<template>
    <a-modal v-model:visible="visible" width="1000px">
        <a-spin tip="Loading..." :spinning="spinning" v-if="addresses.length">
            <div class="row">
                <div class="col-lg-4 col-md-6" v-for="address in addresses">
                    <a-card hoverable style="width: 100%; margin-bottom: 15px">
                        <template #actions>
                            <div key="default">
                                <a-radio-button @click="setDefaultAddress(address.id, address.is_default, address)" value="large"
                                                :class="{'defaulted': address.is_default}">Default<span
                                    v-if="address.is_default">ed</span></a-radio-button>
                            </div>
                            <div key="edit">
                                <a-dropdown :trigger="['click']">
                                    <template #overlay>
                                        <a-menu>
                                            <a-menu-item key="1" @click="editAddress(address)">
                                                <edit-outlined/>
                                                Edit
                                            </a-menu-item>
                                            <a-menu-item key="2" @click="deleteAddress(address.id)">
                                                <delete-outlined/>
                                                Delete
                                            </a-menu-item>
                                        </a-menu>
                                    </template>
                                    <a-button type="text">
                                        <ellipsis-outlined/>
                                    </a-button>
                                </a-dropdown>
                            </div>
                        </template>
                        <a-card-meta :title="address.receiver">
                            <template #description>
                                <div>
                                    {{ address.address_full }}
                                </div>
                                <div>
                                    {{ address.phone }}
                                </div>
                                <div>
                                    {{ address.address }}
                                </div>
                            </template>
                        </a-card-meta>
                    </a-card>
                </div>
            </div>
        </a-spin>
        <a-empty v-else />
        <template #footer>
            <a-button key="addAddress" @click="openAddModal">
                <a-icon type="plus"/>
                Thêm địa chỉ
            </a-button>
            <a-button key="ok" type="primary" @click="closeModal">
                Hoàn tất
            </a-button>
        </template>
    </a-modal>
    <AddressModal ref="modal" :tinhs="tinhs"/>
</template>

<script>
import {useForm, Link} from "@inertiajs/inertia-vue3";
import {EditOutlined, UserOutlined, EllipsisOutlined, DeleteOutlined, SettingOutlined} from "@ant-design/icons-vue";
import AddressModal from "./AddressModal.vue";
import {notification} from "ant-design-vue";
import {getErrorMessage} from "../../../Helper/stringHelper";

export default {
    name: "AdressListModal",
    components: {AddressModal, EditOutlined, UserOutlined, EllipsisOutlined, Link, DeleteOutlined, SettingOutlined},
    data() {
        return {
            visible: false,
            default_address: null,
            selected_address: null,
            spinning: false
        }
    },
    props: {
        tinhs: {
            type: Array,
        },
        addresses: {
            type: Array,
        },
    },
    setup() {
        const form = useForm({
            id: null,
            old_default: null,
        })

        return {
            form,
        };
    },
    mounted() {
    },
    created() {

    },
    methods: {
        openAddModal() {
            this.$refs.modal.visible = true;
        },
        closeModal() {
            this.visible = false;
        },
        deleteAddress(id) {
            this.spinning = true;
            this.$inertia.delete(route('client.carts.delete.user_info', id), {
                onFinish: () => {
                    this.spinning = false;
                }
            });
        },
        setDefaultAddress(id, is_default, address) {
            if (!is_default) {
                this.spinning = true;
                this.form.old_default = this.currentDefaultAddress;
                this.form.id = id;
                this.form.put(route('client.carts.update.user_info'), {
                    onSuccess: () => {
                        notification.success({
                            message: 'Thành công',
                            description: 'Đã đặt địa chỉ mặc định',
                        });
                        this.$emit('updateDefaultAddress', address);
                    },
                    onError: (e) => {
                        notification.error({
                            message: 'Error',
                            description: getErrorMessage(e),
                        });
                    },
                    onFinish: () => {
                        this.spinning = false;
                    }
                });
            }
        },
        currentDefaultAddress() {
            return this.addresses.filter(address => address.is_default)[0].id;
        },
        editAddress(address) {
            console.log(address);
            this.$refs.modal.visible = true;
            this.$refs.modal.setForm(address);
        }
    },
}
</script>

<style scoped>
.defaulted {
    background: #87d068;
}
</style>
