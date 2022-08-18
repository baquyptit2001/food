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
                        <a-input-number v-model:value="form.discount" @change="numberToText">
                            <template #addonAfter>
                                <span v-if="form.type">VND</span>
                                <span v-else>%</span>
                            </template>
                        </a-input-number>
                        <div v-if="discount_text !== ''">{{ discount_text }}</div>
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
                        <a-input-number v-model:value="form.maximum_uses" :controls="false" min="1" v-if="isLimit === true"
                                        style="width: 200px; margin-left: 10px">
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
                <a-input-number v-model:value="form.minimum_price" style="width: 200px" min="0" :controls="false" @change="numberToText">
                    <template #addonAfter>
                        VNĐ
                    </template>
                </a-input-number>
                <div v-if="min_price_text !== ''">{{ min_price_text }}</div>
            </div>
            <div class="col-md-6 mt-2">
                <a-typography-title :level="5">
                    Giảm tối đa
                </a-typography-title>
                <a-input-number v-model:value="form.maximum_discount" style="width: 200px" min="0" :controls="false" @change="numberToText">
                    <template #addonAfter>
                        VNĐ
                    </template>
                </a-input-number>
                <div v-if="max_discount_text !== ''">{{ max_discount_text }}</div>
            </div>
        </div>
        <a-button type="primary" shape="round" size="middle" class="mt-3" @click="addPromotion" :loading="loading">
            <template #icon>
                <plus-outlined/>
            </template>
            Thêm mới
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
import {Link} from '@inertiajs/inertia-vue3'
import {useForm} from '@inertiajs/inertia-vue3'
import {PlusOutlined, RollbackOutlined} from "@ant-design/icons-vue";
import {reactive} from "vue";
import {notification} from "ant-design-vue";
import {getErrorMessage} from "../../../Helper/stringHelper";
import {getText} from "number-to-text-vietnamese";
import {isNaN} from "lodash";

export default {
    name: "Create",
    components: {AdminLayout, Link, PlusOutlined, RollbackOutlined},
    mounted() {
        this.$refs.layout.setBreadItems(["Promotions", "Create"]);
        this.$refs.layout.setSelected(["15"]);
        document.title = "Create Promotions";
        this.numberToText();
    },
    setup() {
        const form = useForm({
            name: '',
            description: '',
            discount: 0,
            start_date: new Date(),
            end_date: new Date(),
            type: true,
            minimum_price: null,
            maximum_discount: null,
            rangeDate: null,
            maximum_uses: null,
        });

        const radioStyle = reactive({
            display: 'flex',
            height: '30px',
            lineHeight: '30px',
        });


        return {
            form,
            radioStyle,
        };
    },
    data() {
        return {
            isLimit: false,
            loading: false,
            discount_text: '',
            min_price_text: '',
            max_discount_text: '',
        };
    },
    methods: {
        addPromotion() {
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
            this.form.post(route('admin.promotions.store'), {
                onSuccess: () => {
                    notification.success({
                        message: 'Thành công',
                        description: 'Thêm mới thành công'
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
        },
        numberToText() {
            if(this.form.maximum_discount != null && !isNaN(this.form.maximum_discount)) {
                this.max_discount_text = getText(this.form.maximum_discount, ', ');
            } else {
                this.max_discount_text = '';
            }
            if(this.form.discount != null && !isNaN(this.form.discount)) {
                this.discount_text = getText(this.form.discount, ', ');
            } else {
                this.discount_text = '';
            }
            if(this.form.minimum_price != null && !isNaN(this.form.minimum_price)) {
                this.min_price_text = getText(this.form.minimum_price, ', ');
            } else {
                this.min_price_text = '';
            }
        }
    },
}
</script>

<style scoped>

</style>
