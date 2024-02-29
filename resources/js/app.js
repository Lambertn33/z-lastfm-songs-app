import { createApp, h } from "vue";

import { createInertiaApp } from "@inertiajs/vue3";

import { ZiggyVue } from "../../vendor/tightenco/ziggy/dist/vue.m";

import { OhVueIcon, addIcons } from "oh-vue-icons";

import VueSweetalert2 from 'vue-sweetalert2';

import 'sweetalert2/dist/sweetalert2.min.css';

import {
    FaUserAlt,
    FaLocationArrow,
    CoAlbum,
    FaArrowLeft,
    CoHeadphones,
    MdPlayarrow,
    BiCalendarDate,
    HiEmojiSad,
    MdFavoriteborder,
    MdFavorite
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
    HiEmojiSad,
    MdFavoriteborder,
    MdFavorite
);

createInertiaApp({
    resolve: (name) => {
        const pages = import.meta.glob("./Pages/**/*.vue", { eager: true });
        let page = pages[`./Pages/${name}.vue`];
        page.default.layout = page.default.layout || MainLayout;
        return page;
    },

    setup({ el, App, props, plugin }) {
        const app = createApp({ render: () => h(App, props) });
        
        // Register components
        app.component("v-icon", OhVueIcon);
        app.component("the-navigation", TheNavigation);
        app.component("the-header", TheHeader);
        
        // Use plugins
        app.use(ZiggyVue);
        app.use(VueSweetalert2);
        
        // Mount the app
        app.mount(el);

        // Set window.Swal
        window.Swal = app.config.globalProperties.$swal;
    }
});
