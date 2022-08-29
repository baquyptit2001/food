<template>
    <a-modal v-model:visible="visible" width="1000px" @ok="handleOk">
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
        };
    },
    setup() {
        const form = useForm({
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
    },
    methods: {
        changeTinh(value) {
            this.disabledQuan = true;
            this.disabledXa = true;
            console.log(value);
            this.form.quan = null;
            this.form.xa = null;
            axios.get(this.route('quan', this.form.matp)).then(({data}) => {
                this.quans = data;
                this.disabledQuan = false;
            });
        },
        changeQuan(value) {
            this.disabledXa = true;
            console.log(value);
            this.form.xa = null;
            axios.get(this.route('xa', this.form.maqh)).then(({data}) => {
                this.xas = data;
                this.disabledXa = false;
            });
        },
        handleOk() {
            console.log(this.form);
            this.form.post(route('client.carts.user_info.store'), {
                onSuccess: () => {
                    notification.success({
                        message: 'Thành công',
                        description: 'Cập nhật thông tin thành công',
                    });
                    this.$inertia.reload({
                        onFinish: () => {
                            this.visible = false;
                        },
                    });
                },
                onError: (e) => {
                    notification.error({
                        message: 'Lỗi',
                        description: getErrorMessage(e),
                    });
                }
            })
        },
    },
}
</script>

<style scoped>

</style>
