<template>
    <footer class="mt-3">
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <img src="@/assets/logo.png" style="width: 50%">
                <a-typography-title :level="4" class="link d-flex justify-content-center align-items-center" style="margin-top: 15px">
                    <phone-outlined />
                    <a href="tel:0973043445" style="color: #54555e;">0973043445</a>
                </a-typography-title>
                <a-typography-title :level="4" class="link d-flex justify-content-center align-items-center" style="margin-top: 15px">
                    <mail-outlined />
                    <a href="mailto:quynb201@gmail.com" style="color: #54555e;">quynb201@gmail.com</a>
                </a-typography-title>
            </div>
            <div class="col-lg-4 col-md-6 page-list align-items-center" style="display: flex; flex-wrap: wrap">
                <a-typography-title :level="4" class="link">
                    <Link>
                        Menu
                    </Link>
                </a-typography-title>
                <a-typography-title :level="4" class="link">
                    <Link>
                        Giới thiệu
                    </Link>
                </a-typography-title>
                <a-typography-title :level="4" class="link">
                    <Link>
                        Liên hệ
                    </Link>
                </a-typography-title>
                <a-typography-title :level="4" class="link">
                    <Link>
                        Ưu đãi
                    </Link>
                </a-typography-title>
                <a-typography-title :level="4" class="link">
                    <Link>
                        Đặt món
                    </Link>
                </a-typography-title>
            </div>
            <div class="col-lg-4 col-md-6">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3725.047704067072!2d105.78388299999999!3d20.9907248!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135acb67ddf0cbd%3A0xc8c8cf8450cdf8d!2sKaopiz%20Software%20Co.%2C%20Ltd.!5e0!3m2!1svi!2s!4v1660121747974!5m2!1svi!2s"
                    width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
        <div class="text-center" style="font-weight: bold; color: #54555e">
            Copyright © 2022. All rights reserved.
        </div>
    </footer>
</template>

<script>

import {Link} from '@inertiajs/inertia-vue3';
import {PhoneOutlined, MailOutlined} from "@ant-design/icons-vue";

export default {
    name: "Footer",
    components: {Link, PhoneOutlined, MailOutlined},
}
</script>

<style scoped>
footer {
    text-align: center;
    padding: 20px;
    background-color: #c0c4c8;
}

.link a {
    color: #e3571a;
}

.page-list .link{
    width: 100%;
    margin: 5px 0;
}
</style>
