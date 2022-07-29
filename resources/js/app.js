import './bootstrap';
import '../css/app.css';

import {createApp, h} from 'vue';
import {createInertiaApp} from '@inertiajs/inertia-vue3';
import {InertiaProgress} from '@inertiajs/progress';
import {resolvePageComponent} from 'laravel-vite-plugin/inertia-helpers';
import {ZiggyVue} from '../../vendor/tightenco/ziggy/dist/vue.m';
import 'ant-design-vue/dist/antd.css';
import Antd from 'ant-design-vue';
import {createStore} from "vuex";
import {sidetab} from "./Store/sidetab";

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';

const store = createStore({
    modules: {
        sidetab
    }
})

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({el, app, props, plugin}) {
        return createApp({render: () => h(app, props)})
            .use(plugin)
            .use(ZiggyVue, Ziggy)
            .use(Antd)
            .mount(el);
    },
});

InertiaProgress.init({color: '#4B5563'});
