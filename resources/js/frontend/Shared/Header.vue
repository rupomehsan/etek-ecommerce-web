<template>
    <header>
        <!-- middle part -->
        <div class="layout-header2">
            <div class="custom-container">
                <div class="main-menu-block">
                    <div class="header-left">
                        <div class="brand-logo logo-sm-center">
                            <Link href="/">
                                <img :src="`/${get_setting_value('header_logo')}`" alt="ETEK Enterprise">
                            </Link>
                        </div>
                    </div>
                    <div class="input-block">
                        <SearchBar />
                    </div>
                    <div class="header-right ">
                        <template v-if="auth_info">
                            <div class="header_right_profile">
                                <header-cart-count />
                                <div class="auth">
                                    <Link href="/profile">
                                        <img v-if="auth_info?.photo" :src="load_image(auth_info.photo)" />
                                        <div v-else>
                                            <img src="/icons/profile.png" />
                                            <span>
                                                {{ auth_info?.name }}
                                            </span>
                                        </div>
                                    </Link>
                                </div>
                            </div>
                        </template>
                        <template v-else>
                            <div class="header_right_profile">
                                <header-cart-count />
                                <div class="auth">
                                    <a href="#" onclick="openAccount()">
                                        <img src="/icons/profile.png" />
                                        <span>Login</span>
                                    </a>
                                </div>
                            </div>
                        </template>
                        <div class="menu-nav">
                            <span class="toggle-nav" @click="toggle_nav">
                                <i class="fa fa-bars "></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
</template>

<script>
import { Link, usePage } from "@inertiajs/vue3";
import SearchBar from "./Components/SearchBar.vue";
import { common_store } from "../Store/common_store";
import { auth_store } from "../Store/auth_store";
import { mapActions, mapState, mapWritableState } from "pinia";
import Skeleton from '../Components/Skeleton.vue';
import HeaderCartCount from "./Components/HeaderCartCount.vue";
export default {
    components: { Link, SearchBar, Skeleton, HeaderCartCount },
    data: () => ({
        order_track_show: false
    }),
    watch: {
        all_cart_data: function(v){

        }
    },
    methods: {
        load_image: window.load_image,
        toggle_nav: function () {
            this.$refs.main_menu.classList.toggle("active");
        },

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

        toggle_category: function () {
            document.querySelector('.modal_category_all_page').classList.toggle('active');
        },

        TrackOrderForm: function () {
            this.track_customer_order()
        }
    },
    computed: {
        ...mapState(common_store, {
            all_cart_data: "all_cart_data",
            // website_settings_data: "website_settings_data",
            navbar_menu_data: "navbar_menu_data",
            preloader: "preloader",
        }),
        ...mapState(auth_store, {
            "is_auth": "is_auth",
            "auth_info": "auth_info",
        }),
        ...mapWritableState(common_store, [
            'website_settings_data',
        ])
    },
};
</script>
