<template>
    <AdminLayout ref="layout">
        <a-typography-title>
            Cập nhật mã giảm giá
        </a-typography-title>
        <div class="row">
            <div class="col-md-6">
                <a-typography-title :level="5">
                    Tên mã
                </a-typography-title>
                <a-input v-model:value="form.name" placeholder="Tên mã giảm giá"/>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-6">
                        <a-typography-title :level="5">
                            Mức giảm giá
                        </a-typography-title>
                        <a-input-number v-model:value="form.discount">
                            <template #addonAfter>
                                <span v-if="form.type">VND</span>
                                <span v-else>%</span>
                            </template>
                        </a-input-number>
                    </div>
                    <div class="col-6">
                        <a-typography-title :level="5">
                            Loại voucher
                        </a-typography-title>
                        <a-radio-group v-model:value="form.type">
                            <a-radio-button :value="true">Theo giá</a-radio-button>
                            <a-radio-button :value="false">Theo %</a-radio-button>
                        </a-radio-group>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mt-2">
                <a-typography-title :level="5">
                    Thời gian áp dụng
                </a-typography-title>
                <a-range-picker v-model:value="form.rangeDate"/>
            </div>
            <div class="col-md-6 mt-2">
                <a-typography-title :level="5">
                    Giới hạn số lượng
                </a-typography-title>
                <a-radio-group v-model:value="isLimit">
                    <a-radio :style="radioStyle" :value="false">Không giới hạn</a-radio>
                    <a-radio :style="radioStyle" :value="true">
                        Giới hạn
                        <a-input-number v-model:value="form.maximum_uses" :controls="false" min="1"
                                        v-if="isLimit === true"
                                        style="width: 200px; margin-left: 10px; margin-top: 10px">
                            <template #addonAfter>
                                <span>Voucher</span>
                            </template>
                        </a-input-number>
                    </a-radio>
                </a-radio-group>
            </div>
            <div class="col-md-6 mt-2">
                <a-typography-title :level="5">
                    Giá trị đơn hàng tối thiểu
                </a-typography-title>
                <a-input-number v-model:value="form.minimum_price" style="width: 200px" min="0" :controls="false">
                    <template #addonAfter>
                        VNĐ
                    </template>
                </a-input-number>
            </div>
            <div class="col-md-6 mt-2">
                <a-typography-title :level="5">
                    Giảm tối đa
                </a-typography-title>
                <a-input-number v-model:value="form.maximum_discount" style="width: 200px" min="0" :controls="false">
                    <template #addonAfter>
                        VNĐ
                    </template>
                </a-input-number>
            </div>
        </div>
        <a-button type="primary" shape="round" size="middle" class="mt-3" @click="update" :loading="loading">
            <template #icon>
                <setting-outlined/>
            </template>
            Cập nhật
        </a-button>
        <Link :href="route('admin.promotions.index')">
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
import {Link, useForm} from '@inertiajs/inertia-vue3';
import {SettingOutlined, RollbackOutlined} from '@ant-design/icons-vue';
import dayjs from 'dayjs';
import {notification} from "ant-design-vue";
import {getErrorMessage} from "../../../Helper/stringHelper";

export default {
    name: "Edit",
    components: {AdminLayout, Link, SettingOutlined, RollbackOutlined},
    props: {
        promotion: Object
    },
    data() {
        return {
            isLimit: false,
            loading: false
        };
    },
    setup() {
        const radioStyle = {
            display: 'block',
            height: '30px',
            lineHeight: '30px',
        };

        const form = useForm({
            name: '',
            description: '',
            discount: 0,
            start_date: new Date(),
            end_date: new Date(),
            type: true,
            minimum_price: null,
            maximum_discount: null,
            rangeDate: [],
            maximum_uses: null,
        });

        return {
            radioStyle,
            form
        };
    },
    mounted() {
        this.$refs.layout.setBreadItems(['Promotions', 'Update']);
        this.$refs.layout.setSelected([14]);
        this.setFormValue();
    },
    methods: {
        setFormValue() {
            this.form.name = this.promotion.data.name;
            this.form.description = this.promotion.data.description;
            this.form.discount = this.promotion.data.discount;
            this.form.start_date = this.promotion.data.start_date;
            this.form.end_date = this.promotion.data.end_date;
            this.form.type = this.promotion.data.type;
            this.form.minimum_price = this.promotion.data.minimum_price;
            this.form.maximum_discount = this.promotion.data.maximum_discount;
            this.form.maximum_uses = this.promotion.data.maximum_uses;
            if (this.form.maximum_uses) {
                this.isLimit = true;
            }
            this.form.rangeDate = [dayjs(this.promotion.data.start_date), dayjs(this.promotion.data.end_date)];
        },
        update() {
            this.loading = true;
            if (!this.form.rangeDate) {
                notification.error({
                    message: 'Thất bại',
                    description: 'Ngày không được bỏ trống'
                })
                this.loading = false;
                return 0;
            }
            if (!this.form.type) {
                if (this.form.discount > 100) {
                    notification.error({
                        message: 'Thất bại',
                        description: 'Giảm tối đa 100% thôi'
                    })
                    this.loading = false;
                    return 0;
                }
            }
            if (!this.isLimit) {
                this.form.maximum_uses = null;
            }
            this.form.start_date = this.getDate(this.form.rangeDate[0]);
            this.form.end_date = this.getDate(this.form.rangeDate[1]);
            this.form.put(route('admin.promotions.update', this.promotion.data.id), {
                onSuccess: () => {
                    notification.success({
                        message: 'Thành công',
                        description: 'Cập nhật thành công'
                    })
                },
                onError: (e) => {
                    notification.error({
                        message: 'Thất bại',
                        description: getErrorMessage(e)
                    })
                },
                onFinish: () => {
                    this.loading = false;
                }
            })
        },
        getDate(date) {
            return new Date(date.$d.toJSON()).toLocaleDateString("en-US");
        }
    }
}
</script>

<style scoped>

</style>
