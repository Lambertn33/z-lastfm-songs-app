import { createApp, h } from 'vue'

import { createInertiaApp } from '@inertiajs/vue3'

import { ZiggyVue } from "../../vendor/tightenco/ziggy/dist/vue.m";

import { OhVueIcon, addIcons } from "oh-vue-icons";

import { FaUserAlt, FaLocationArrow, CoAlbum  } from "oh-vue-icons/icons";

import MainLayout from "./components/MainLayout.vue"

import '../css/app.css'

addIcons(FaUserAlt, FaLocationArrow, CoAlbum );

createInertiaApp({
  resolve: name => {
    const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })
    let page = pages[`./Pages/${name}.vue`]
    page.default.layout = page.default.layout || MainLayout
    return page
  },


  setup({ el, App, props, plugin }) {
    createApp({ render: () => h(App, props) })
      .use(plugin)
      .component("v-icon", OhVueIcon)
      .use(ZiggyVue)
      .mount(el)
  },
})