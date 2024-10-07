<template>

    <Header v-if="window_width > 574" />
    <HeaderSearchMobile v-if="window_width <= 574"/>

    <div class="main-wrapper box-shadow">
        <slot />
    </div>
    <Footer />
</template>

<script>
import Header from "./Header.vue";
import HeaderSearchMobile from "./HeaderSearchMobile.vue";
import Footer from "./Footer.vue";
import { common_store } from "../Store/common_store";
import { auth_store } from "../Store/auth_store";
import { mapActions, mapState, mapWritableState } from "pinia";
import {use_home_page_store} from "../Pages/Home/Store/home_page_store";

export default {
    components: { Header, Footer, HeaderSearchMobile },
    created: async function () {
        // this.get_parent_categories();
    },
    methods: {
        ...mapActions(common_store, {
            get_all_cart_data: "get_all_cart_data",
            get_all_website_settings: "get_all_website_settings",
            get_all_website_navbar_menu: "get_all_website_navbar_menu",
            track_customer_order: "track_customer_order",
            get_setting_value: "get_setting_value",
        }),
        ...mapActions(auth_store, {
            "check_is_auth": "check_is_auth",
        }),
        ...mapActions(use_home_page_store,{
            get_side_nav_categories: "get_side_nav_categories",
            get_parent_categories: "get_parent_categories",
        })
    },
    computed: {
        ...mapState(auth_store, {
            "is_auth": "is_auth",
        }),
        ...mapWritableState(common_store, [
            'website_settings_data',
        ]),
        window_width: function(){
            return window.innerWidth;
        }
    }
};
</script>

<style></style>
