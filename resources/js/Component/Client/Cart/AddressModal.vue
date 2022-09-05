<template>
    <a-modal v-model:visible="visible" width="1000px" @ok="handleOk" @cancel="resetForm">
        <a-spin tip="Loading" :spinning="spinning">
            <div class="row justify-content-center">
                <div class="col-10">
                    <a-form-item label="Tên người nhận: ">
                        <a-input v-model:value="form.receiver" style="width: 200px"/>
                    </a-form-item>
                    <a-form-item label="Số điện thoại: ">
                        <a-input v-model:value="form.phone" style="width: 200px"/>
                    </a-form-item>
                    <a-form-item label="Tỉnh/ Thành phố: ">
                        <a-select
                            ref="select"
                            v-model:value="form.matp"
                            style="width: 200px"
                            @change="changeTinh"
                            allowClear
                        >
                            <a-select-option v-for="t in tinhs" :value="t.matp" :key="t.matp">
                                {{ t.name }}
                            </a-select-option>
                        </a-select>
                    </a-form-item>
                    <a-form-item label="Quận/ Huyện: ">
                        <a-select
                            ref="select"
                            v-model:value="form.maqh"
                            style="width: 200px"
                            @change="changeQuan"
                            :disabled="disabledQuan"
                            allowClear
                        >
                            <a-select-option v-for="q in quans" :key="q.maqh" :value="q.maqh">
                                {{ q.name }}
                            </a-select-option>
                        </a-select>
                    </a-form-item>
                    <a-form-item label="Xã/ Phường: ">
                        <a-select
                            ref="select"
                            v-model:value="form.xaid"
                            style="width: 200px"
                            @change="changeXa"
                            :disabled="disabledXa"
                            allowClear
                        >
                            <a-select-option v-for="x in xas" :key="x.xaid" :value="x.xaid">
                                {{ x.name }}
                            </a-select-option>
                        </a-select>
                    </a-form-item>
                    <a-form-item label="Địa chỉ: ">
                        <a-input v-model:value="form.address" style="width: 200px"/>
                    </a-form-item>
                </div>
            </div>
        </a-spin>
    </a-modal>
</template>

<script>
import {useForm} from "@inertiajs/inertia-vue3";
import {notification} from "ant-design-vue";
import {getErrorMessage} from "../../../Helper/stringHelper";

export default {
    name: "AddressModal",
    props: {
        tinhs: {
            type: Array,
        },
    },
    data() {
        return {
            visible: false,
            quans: [],
            xas: [],
            disabledQuan: true,
            disabledXa: true,
            loading: false,
            spinning: false,
        };
    },
    setup() {
        const form = useForm({
            id: null,
            matp: null,
            maqh: null,
            xaid: null,
            address: null,
            receiver: null,
            phone: null,
        })

        return {
            form,
        };
    },
    mounted() {
        this.form.receiver = this.$page.props.user.data.name
        this.getQuan()
        this.getXa()
    },
    methods: {
        changeTinh() {
            this.disabledQuan = true;
            this.disabledXa = true;
            this.form.maqh = null;
            this.form.xaid = null;
            this.getQuan();
        },
        getQuan() {
            if (this.form.matp) {
                axios.get(this.route('quan', this.form.matp)).then(({data}) => {
                    this.quans = data;
                    this.disabledQuan = false;
                });
            }
        },
        changeQuan(value) {
            this.disabledXa = true;
            this.form.xaid = null;
            this.getXa()
        },
        getXa() {
            if (this.form.maqh) {
                axios.get(this.route('xa', this.form.maqh)).then(({data}) => {
                    this.xas = data;
                    this.disabledXa = false;
                });
            }
        },
        handleOk() {
            this.spinning = true;
            if (this.form.id) {
                this.updateAddress();
            } else {
                this.addNewAddress()
            }
        },
        addNewAddress() {
            this.form.post(route('client.carts.user_info.store'), {
                onSuccess: () => {
                    notification.success({
                        message: 'Thành công',
                        description: 'Cập nhật thông tin thành công',
                    });
                    this.$inertia.reload({
                        onFinish: () => {
                            this.visible = false;
                            this.spinning = false;
                        },
                    });
                },
                onError: (e) => {
                    notification.error({
                        message: 'Lỗi',
                        description: getErrorMessage(e),
                    });
                    this.spinning = false;
                }
            })
        },
        updateAddress() {
            this.form.put(route('client.carts.update.user_info_address', this.form.id), {
                onSuccess: () => {
                    notification.success({
                        message: 'Thành công',
                        description: 'Cập nhật thông tin thành công',
                    });
                },
                onError: (e) => {
                    notification.error({
                        message: 'Lỗi',
                        description: getErrorMessage(e),
                    });
                },
                onFinish: () => {
                    this.visible = false;
                    this.spinning = false;
                },
            })
        },
        resetForm() {
            this.form.reset();
            this.visible = false;
        },
        setForm(data) {
            this.form.id = data.id;
            this.form.matp = data.tinh.id;
            this.form.maqh = data.quan.id;
            this.form.xaid = data.xa.id;
            this.form.address = data.address;
            this.form.receiver = data.receiver;
            this.form.phone = data.phone;
            this.getQuan();
            this.getXa();
        },
    },
}
</script>

<style scoped>

</style>
