<template>
    <a-modal v-model:visible="visible" width="1000px">
        <div class="row">
            <div class="col-lg-4 col-md-6" v-for="address in addresses">
                <a-card hoverable style="width: 100%; margin-bottom: 15px">
                    <template #actions>
                        <div key="default">
                            <input :checked="address.is_default" :id="'r' + address.id" type="radio" :value="address.id" name="default" v-model="default_address"/>
                            <label :for="'r' + address.id" style="margin-left: 5px">Default</label>
                        </div>
                        <div key="edit">
                            <edit-outlined/>
                            Sửa
                        </div>
                        <div key="default">
                            <input :id="'s' + address.id" type="radio" name="selected" :checked="address.is_default" value="1" v-model="selected_address"/>
                            <label :for="'s' + address.id" style="margin-left: 5px">Selected</label>
                        </div>
                    </template>
                    <a-card-meta :title="address.user.name">
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
import {useForm} from "@inertiajs/inertia-vue3";
import {EditOutlined} from "@ant-design/icons-vue";
import AddressModal from "./AddressModal.vue";

export default {
    name: "AdressListModal",
    components: {AddressModal, EditOutlined},
    data() {
        return {
            visible: false,
            default_address: null,
            selected_address: null,
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
    mounted() {
        console.log(this.addresses);
    },
    methods: {
        openAddModal() {
            this.$refs.modal.visible = true;
        },
        closeModal() {
            this.visible = false;
        },
    },
}
</script>

<style scoped>

</style>
