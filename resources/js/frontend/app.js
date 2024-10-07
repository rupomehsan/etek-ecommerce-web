import "../frontend/plugins/sweet_alert.js";
import "../frontend/plugins/axios_setup.js";
import "../frontend/plugins/helper_functions.js";
import { router } from '@inertiajs/vue3'

import { createApp, h } from "vue";
import { createInertiaApp, Head, Link } from "@inertiajs/vue3";
import { createPinia, mapActions, mapWritableState } from "pinia";
import { common_store } from "./Store/common_store.js";
import { auth_store } from "./Store/auth_store.js";
import { cart_store } from "./Store/cart_store.js";
import { use_home_page_store } from "./Pages/Home/Store/home_page_store.js";
import axios from "axios";

const pinia = createPinia();

window.page_data = () => {
    try {
        return JSON.parse(document.querySelector('#app').dataset.page);
    } catch (error) {
        return {};
    }
};

window.set_default_data = async function () {
    let auth_stores = auth_store();
    let is_auth = await auth_stores.check_is_auth();
    if(is_auth?.data?.slug && !window.page_data().props?.auth?.slug){
        await axios.post(location.origin+'/custom-auth',{slug: is_auth.data.slug});
        window.location.reload();
    }

    let store_common = mapWritableState(common_store, [
        'website_settings_data',
    ]);

    let auth_store_common = mapWritableState(auth_store, [
        'auth_info',
        'is_auth',
        'role',
    ]);

    let cart_store_state = mapWritableState(cart_store, [
        "carts",
    ])

    let home_page_store = mapWritableState(use_home_page_store, [
        "parent_categories",
    ])

    let settings = window.page_data().props?.settings;
    let auth_store_data = window.page_data().props?.auth;
    let cart_data = window.page_data().props?.all_cart_data;
    let all_category_parents = window.page_data().props?.all_category_parents;

    store_common.website_settings_data.set(settings);
    auth_store_common.auth_info.set(auth_store_data);
    home_page_store.parent_categories.set(all_category_parents);

    if (auth_store_data) {
        auth_store_common.is_auth.set(true);
        auth_store_common.role.set(auth_store_data.role);
    }

    if (!auth_store_data) {
        if (localStorage.getItem('carts')) {
            cart_store_state.carts.set(JSON.parse(localStorage.getItem('carts')));
        }
    }else{
        cart_store_state.carts.set(cart_data);
    }

    return {
        auth_info: auth_store_data,
    }
    // store_common_action.get_all_cart_data();
}

createInertiaApp({
    // title: title => title ? `${title} - Ping CRM` : 'Ping CRM',
    resolve: (name) => {
        const pages = import.meta.glob("./Pages/**/*.vue", { eager: true });
        return pages[`./Pages/${name}.vue`];
    },
    setup({ el, App, props, plugin }) {
        const app = createApp({
            render: () => h(App, props),
        });
        app.use(pinia);

        let res = window.set_default_data();

        app.config.globalProperties.auth_info = res.auth_info;
        app.config.globalProperties.load_image = window.load_image;
        app.config.globalProperties.number_format = function (number = 0) {
            try {
                return new Intl.NumberFormat().format(number)
            } catch (error) {
                return number;
            }
        }

        app.use(plugin);
        app.component("Link", Link);
        app.component('Head', Head);
        app.mount(el);

    },

});


