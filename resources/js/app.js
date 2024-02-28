import { createApp, h } from "vue";

import { createInertiaApp } from "@inertiajs/vue3";

import { ZiggyVue } from "../../vendor/tightenco/ziggy/dist/vue.m";

import { OhVueIcon, addIcons } from "oh-vue-icons";

import {
    FaUserAlt,
    FaLocationArrow,
    CoAlbum,
    FaArrowLeft,
    CoHeadphones,
    MdPlayarrow,
    BiCalendarDate,
    HiEmojiSad,
} from "oh-vue-icons/icons";

import MainLayout from "./components/MainLayout.vue";

import TheHeader from "./components/UI/TheHeader.vue";

import TheNavigation from "./components/UI/ThePagination.vue";

import "../css/app.css";

addIcons(
    FaUserAlt,
    FaLocationArrow,
    CoAlbum,
    FaArrowLeft,
    CoHeadphones,
    MdPlayarrow,
    BiCalendarDate,
    HiEmojiSad
);

createInertiaApp({
    resolve: (name) => {
        const pages = import.meta.glob("./Pages/**/*.vue", { eager: true });
        let page = pages[`./Pages/${name}.vue`];
        page.default.layout = page.default.layout || MainLayout;
        return page;
    },

    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .component("v-icon", OhVueIcon)
            .component("the-navigation", TheNavigation)
            .component("the-header", TheHeader)
            .use(ZiggyVue)
            .mount(el);
    },
});
