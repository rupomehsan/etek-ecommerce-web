<template>
    <header>
        <!-- top header part -->
        <div class="top-header">
            <div class="custom-container">
                <div class="row">
                    <div class="col-xl-5 col-md-7 col-sm-6">
                        <div class="top-header-left">
                            <div class="shpping-order">
                                <h6> {{ get_setting_value('shiping_on_order') }} </h6>
                            </div>
                            <div class="app-link">
                                <h6>
                                    Download aap
                                </h6>
                                <ul>
                                    <li><a><i class="fa fa-apple"></i></a></li>
                                    <li><a><i class="fa fa-android"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-7 col-md-5 col-sm-6">
                        <div class="top-header-right">
                            <div class="top-menu-block">
                                <ul>
                                    <li>
                                        <a :href="get_setting_value('facebook')"><i class="fa fa-facebook"></i></a>
                                    </li>

                                    <li>
                                        <a :href="get_setting_value('twitter')"><i class="fa fa-twitter"></i></a>
                                    </li>
                                    <li>
                                        <a :href="get_setting_value('instagram')"><i class="fa fa-instagram"></i></a>
                                    </li>
                                    <li>
                                        <a :href="get_setting_value('youtube')"><i class="fa fa-youtube"></i></a>
                                    </li>

                                    <template v-if="is_auth">
                                        <li class="order-track">
                                            <a href="javascript:void(0)"
                                                @click="order_track_show = !order_track_show">track
                                                order</a>
                                            <form @submit.prevent="TrackOrderForm" v-if="order_track_show">
                                                <div class="d-flex">
                                                    <input type="search" name="order_id" id="">
                                                    <button type="submit"><i class="fa fa-search"></i></button>
                                                </div>
                                            </form>
                                        </li>
                                    </template>
                                    <template v-if="!is_auth">
                                        <li>
                                            <Link href="/login">login</Link>
                                        </li>
                                        <li>
                                            <Link href="/register">register</Link>
                                        </li>
                                    </template>

                                    <!-- <li><a href="javascript:void(0)">Notifications</a></li> -->
                                    <!-- <li><a href="javascript:void(0)">gift cards</a></li> -->
                                    <!-- <li><a href="javascript:void(0)">shipping </a></li> -->
                                    <!-- <li><a href="javascript:void(0)">easy returns</a></li> -->
                                </ul>
                            </div>
                            <div class="language-block">
                                <!-- <div class="language-dropdown">
                                    <span class="language-dropdown-click">
                                        english <i class="fa fa-angle-down" aria-hidden="true"></i>
                                    </span>
                                    <ul class="language-dropdown-open" style="display: none;">
                                        <li><a href="javascript:void(0)">hindi</a></li>
                                        <li><a href="javascript:void(0)">english</a></li>
                                        <li><a href="javascript:void(0)">marathi</a></li>
                                        <li><a href="javascript:void(0)">spanish</a></li>
                                    </ul>
                                </div>
                                <div class="curroncy-dropdown">
                                    <span class="curroncy-dropdown-click">
                                        usd<i class="fa fa-angle-down" aria-hidden="true"></i>
                                    </span>
                                    <ul class="curroncy-dropdown-open" style="display: none;">
                                        <li><a href="javascript:void(0)"><i class="fa fa-inr"></i>inr</a></li>
                                        <li><a href="javascript:void(0)"><i class="fa fa-usd"></i>usd</a></li>
                                        <li><a href="javascript:void(0)"><i class="fa fa-eur"></i>eur</a></li>
                                    </ul>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- middle part -->
        <div class="layout-header2">
            <div class="custom-container">
                <div class="main-menu-block">
                    <div class="header-left">
                        <div class="brand-logo logo-sm-center">
                            <div v-if="preloader" class="d-flex align-items-center gap-3">
                                <skeleton :width="`100px`" :height="`100px`" :isCircle="true"></skeleton>
                                <skeleton :width="`300px`" :height="`50px`"></skeleton>
                            </div>
                            <Link v-else href="/">
                            <img :src="`/${get_setting_value('header_logo')}`" class="img-fluid"
                                alt="ETEK Enterprise Logo">
                            </Link>
                        </div>
                    </div>
                    <div class="input-block">
                        <SearchBar />
                    </div>
                    <div class="header-right ">
                        <template v-if="is_auth">
                            <div class="icon-block">
                                <ul>
                                    <li class="mobile-user ">
                                        <Link href="/profile">
                                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                            viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;"
                                            xml:space="preserve">
                                            <g>
                                                <g>
                                                    <path
                                                        d="M256,0c-74.439,0-135,60.561-135,135s60.561,135,135,135s135-60.561,135-135S330.439,0,256,0z M256,240
                            c-57.897,0-105-47.103-105-105c0-57.897,47.103-105,105-105c57.897,0,105,47.103,105,105C361,192.897,313.897,240,256,240z">
                                                    </path>
                                                </g>
                                            </g>
                                            <g>
                                                <g>
                                                    <path
                                                        d="M297.833,301h-83.667C144.964,301,76.669,332.951,31,401.458V512h450V401.458C435.397,333.05,367.121,301,297.833,301z
                            M451.001,482H451H61v-71.363C96.031,360.683,152.952,331,214.167,331h83.667c61.215,0,118.135,29.683,153.167,79.637V482z">
                                                    </path>
                                                </g>
                                            </g>
                                        </svg>
                                        </Link>
                                    </li>
                                    <!-- <li class="mobile-setting" onclick="openSetting()">
                                    <a href="javascript:void(0)">
                                        <svg enable-background="new 0 0 512 512" viewBox="0 0 512 512"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="m272.066 512h-32.133c-25.989 0-47.134-21.144-47.134-47.133v-10.871c-11.049-3.53-21.784-7.986-32.097-13.323l-7.704 7.704c-18.659 18.682-48.548 18.134-66.665-.007l-22.711-22.71c-18.149-18.129-18.671-48.008.006-66.665l7.698-7.698c-5.337-10.313-9.792-21.046-13.323-32.097h-10.87c-25.988 0-47.133-21.144-47.133-47.133v-32.134c0-25.989 21.145-47.133 47.134-47.133h10.87c3.531-11.05 7.986-21.784 13.323-32.097l-7.704-7.703c-18.666-18.646-18.151-48.528.006-66.665l22.713-22.712c18.159-18.184 48.041-18.638 66.664.006l7.697 7.697c10.313-5.336 21.048-9.792 32.097-13.323v-10.87c0-25.989 21.144-47.133 47.134-47.133h32.133c25.989 0 47.133 21.144 47.133 47.133v10.871c11.049 3.53 21.784 7.986 32.097 13.323l7.704-7.704c18.659-18.682 48.548-18.134 66.665.007l22.711 22.71c18.149 18.129 18.671 48.008-.006 66.665l-7.698 7.698c5.337 10.313 9.792 21.046 13.323 32.097h10.87c25.989 0 47.134 21.144 47.134 47.133v32.134c0 25.989-21.145 47.133-47.134 47.133h-10.87c-3.531 11.05-7.986 21.784-13.323 32.097l7.704 7.704c18.666 18.646 18.151 48.528-.006 66.665l-22.713 22.712c-18.159 18.184-48.041 18.638-66.664-.006l-7.697-7.697c-10.313 5.336-21.048 9.792-32.097 13.323v10.871c0 25.987-21.144 47.131-47.134 47.131zm-106.349-102.83c14.327 8.473 29.747 14.874 45.831 19.025 6.624 1.709 11.252 7.683 11.252 14.524v22.148c0 9.447 7.687 17.133 17.134 17.133h32.133c9.447 0 17.134-7.686 17.134-17.133v-22.148c0-6.841 4.628-12.815 11.252-14.524 16.084-4.151 31.504-10.552 45.831-19.025 5.895-3.486 13.4-2.538 18.243 2.305l15.688 15.689c6.764 6.772 17.626 6.615 24.224.007l22.727-22.726c6.582-6.574 6.802-17.438.006-24.225l-15.695-15.695c-4.842-4.842-5.79-12.348-2.305-18.242 8.473-14.326 14.873-29.746 19.024-45.831 1.71-6.624 7.684-11.251 14.524-11.251h22.147c9.447 0 17.134-7.686 17.134-17.133v-32.134c0-9.447-7.687-17.133-17.134-17.133h-22.147c-6.841 0-12.814-4.628-14.524-11.251-4.151-16.085-10.552-31.505-19.024-45.831-3.485-5.894-2.537-13.4 2.305-18.242l15.689-15.689c6.782-6.774 6.605-17.634.006-24.225l-22.725-22.725c-6.587-6.596-17.451-6.789-24.225-.006l-15.694 15.695c-4.842 4.843-12.35 5.791-18.243 2.305-14.327-8.473-29.747-14.874-45.831-19.025-6.624-1.709-11.252-7.683-11.252-14.524v-22.15c0-9.447-7.687-17.133-17.134-17.133h-32.133c-9.447 0-17.134 7.686-17.134 17.133v22.148c0 6.841-4.628 12.815-11.252 14.524-16.084 4.151-31.504 10.552-45.831 19.025-5.896 3.485-13.401 2.537-18.243-2.305l-15.688-15.689c-6.764-6.772-17.627-6.615-24.224-.007l-22.727 22.726c-6.582 6.574-6.802 17.437-.006 24.225l15.695 15.695c4.842 4.842 5.79 12.348 2.305 18.242-8.473 14.326-14.873 29.746-19.024 45.831-1.71 6.624-7.684 11.251-14.524 11.251h-22.148c-9.447.001-17.134 7.687-17.134 17.134v32.134c0 9.447 7.687 17.133 17.134 17.133h22.147c6.841 0 12.814 4.628 14.524 11.251 4.151 16.085 10.552 31.505 19.024 45.831 3.485 5.894 2.537 13.4-2.305 18.242l-15.689 15.689c-6.782 6.774-6.605 17.634-.006 24.225l22.725 22.725c6.587 6.596 17.451 6.789 24.225.006l15.694-15.695c3.568-3.567 10.991-6.594 18.244-2.304z">
                                            </path>
                                            <path
                                                d="m256 367.4c-61.427 0-111.4-49.974-111.4-111.4s49.973-111.4 111.4-111.4 111.4 49.974 111.4 111.4-49.973 111.4-111.4 111.4zm0-192.8c-44.885 0-81.4 36.516-81.4 81.4s36.516 81.4 81.4 81.4 81.4-36.516 81.4-81.4-36.515-81.4-81.4-81.4z">
                                            </path>
                                        </svg>
                                    </a>
                                </li> -->
                                    <li class="mobile-wishlist item-count">
                                        <Link href="/profile/wish-list">
                                        <svg viewBox="0 -28 512.001 512" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="m256 455.515625c-7.289062 0-14.316406-2.640625-19.792969-7.4375-20.683593-18.085937-40.625-35.082031-58.21875-50.074219l-.089843-.078125c-51.582032-43.957031-96.125-81.917969-127.117188-119.3125-34.644531-41.804687-50.78125-81.441406-50.78125-124.742187 0-42.070313 14.425781-80.882813 40.617188-109.292969 26.503906-28.746094 62.871093-44.578125 102.414062-44.578125 29.554688 0 56.621094 9.34375 80.445312 27.769531 12.023438 9.300781 22.921876 20.683594 32.523438 33.960938 9.605469-13.277344 20.5-24.660157 32.527344-33.960938 23.824218-18.425781 50.890625-27.769531 80.445312-27.769531 39.539063 0 75.910156 15.832031 102.414063 44.578125 26.191406 28.410156 40.613281 67.222656 40.613281 109.292969 0 43.300781-16.132812 82.9375-50.777344 124.738281-30.992187 37.398437-75.53125 75.355469-127.105468 119.308594-17.625 15.015625-37.597657 32.039062-58.328126 50.167969-5.472656 4.789062-12.503906 7.429687-19.789062 7.429687zm-112.96875-425.523437c-31.066406 0-59.605469 12.398437-80.367188 34.914062-21.070312 22.855469-32.675781 54.449219-32.675781 88.964844 0 36.417968 13.535157 68.988281 43.882813 105.605468 29.332031 35.394532 72.960937 72.574219 123.476562 115.625l.09375.078126c17.660156 15.050781 37.679688 32.113281 58.515625 50.332031 20.960938-18.253907 41.011719-35.34375 58.707031-50.417969 50.511719-43.050781 94.136719-80.222656 123.46875-115.617188 30.34375-36.617187 43.878907-69.1875 43.878907-105.605468 0-34.515625-11.605469-66.109375-32.675781-88.964844-20.757813-22.515625-49.300782-34.914062-80.363282-34.914062-22.757812 0-43.652344 7.234374-62.101562 21.5-16.441406 12.71875-27.894532 28.796874-34.609375 40.046874-3.453125 5.785157-9.53125 9.238282-16.261719 9.238282s-12.808594-3.453125-16.261719-9.238282c-6.710937-11.25-18.164062-27.328124-34.609375-40.046874-18.449218-14.265626-39.34375-21.5-62.097656-21.5zm0 0">
                                            </path>
                                        </svg>
                                        <!-- <div class="item-count-contain">
                                            2
                                        </div> -->
                                        </Link>
                                    </li>

                                    <li class="mobile-cart item-count" onclick="openCart()">
                                        <a href="javascript:void(0)">
                                            <div class="cart-block">
                                                <div class="cart-icon">
                                                    <svg enable-background="new 0 0 512 512" viewBox="0 0 512 512"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <g>
                                                            <path
                                                                d="m497 401.667c-415.684 0-397.149.077-397.175-.139-4.556-36.483-4.373-34.149-4.076-34.193 199.47-1.037-277.492.065 368.071.065 26.896 0 47.18-20.377 47.18-47.4v-203.25c0-19.7-16.025-35.755-35.725-35.79l-124.179-.214v-31.746c0-17.645-14.355-32-32-32h-29.972c-17.64 0-31.99 14.351-31.99 31.99v31.594l-133.21-.232-9.985-54.992c-2.667-14.694-15.443-25.36-30.378-25.36h-68.561c-8.284 0-15 6.716-15 15s6.716 15 15 15c72.595 0 69.219-.399 69.422.719 16.275 89.632 5.917 26.988 49.58 306.416l-38.389.2c-18.027.069-32.06 15.893-29.81 33.899l4.252 34.016c1.883 15.06 14.748 26.417 29.925 26.417h26.62c-18.8 36.504 7.827 80.333 49.067 80.333 41.221 0 67.876-43.813 49.067-80.333h142.866c-18.801 36.504 7.827 80.333 49.067 80.333 41.22 0 67.875-43.811 49.066-80.333h31.267c8.284 0 15-6.716 15-15s-6.716-15-15-15zm-209.865-352.677c0-1.097.893-1.99 1.99-1.99h29.972c1.103 0 2 .897 2 2v111c0 8.284 6.716 15 15 15h22.276l-46.75 46.779c-4.149 4.151-10.866 4.151-15.015 0l-46.751-46.779h22.277c8.284 0 15-6.716 15-15v-111.01zm-30 61.594v34.416h-25.039c-20.126 0-30.252 24.394-16.014 38.644l59.308 59.342c15.874 15.883 41.576 15.885 57.452 0l59.307-59.342c14.229-14.237 4.13-38.644-16.013-38.644h-25.039v-34.254l124.127.214c3.186.005 5.776 2.603 5.776 5.79v203.25c0 10.407-6.904 17.4-17.18 17.4h-299.412l-35.477-227.039zm-56.302 346.249c0 13.877-11.29 25.167-25.167 25.167s-25.166-11.29-25.166-25.167 11.29-25.167 25.167-25.167 25.166 11.291 25.166 25.167zm241 0c0 13.877-11.289 25.167-25.166 25.167s-25.167-11.29-25.167-25.167 11.29-25.167 25.167-25.167 25.166 11.291 25.166 25.167z">
                                                            </path>
                                                        </g>
                                                    </svg>
                                                </div>
                                                <div class="cart-item">
                                                    <h5>shopping</h5>
                                                    <h5>cart</h5>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="item-count-contain">{{ all_cart_data.length }}</div>
                                    </li>

                                </ul>
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

        <!-- bottom part -->
        <div class="category-header-2">
            <div class="custom-container">
                <div class="row">
                    <div class="col-12">
                        <div class="navbar-menu">
                            <div class="nav-block">
                                <div class="nav-left">
                                    <nav class="navbar" @click="toggle_category">
                                        <button class="navbar-toggler" type="button">
                                            <span class="navbar-icon"><i class="fa fa-arrow-down"></i></span>
                                        </button>
                                        <h5 class="mb-0  text-white title-font">Shop by category</h5>
                                    </nav>
                                </div>
                            </div>
                            <div class="menu-block navbar_main_menu">
                                <nav id="main-nav">
                                    <ul id="main-menu" ref="main_menu" class="sm pixelstrap sm-horizontal">
                                        <li>
                                            <div class="mobile-back text-right" @click="toggle_nav">
                                                Back
                                                <i class="fa fa-angle-right ps-2" aria-hidden="true"></i>
                                            </div>
                                        </li>
                                        <li v-for="item in navbar_menu_data" :key="item">
                                            <Link :href="`${item.external_link}`" class="dark-menu-item">
                                            {{ item.title }}
                                            </Link>
                                        </li>

                                    </ul>
                                </nav>
                            </div>
                            <div class="icon-block">

                            </div>
                            <div class="category-right">
                                <div class="contact-block">
                                    <a  :tel="get_setting_value('phone_numbers')">
                                        <i class="fa fa-volume-control-phone"></i>
                                        <span>call us<span>{{ get_setting_value('phone_numbers') }}</span></span>
                                    </a>
                                </div>
                            </div>
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
import { mapActions, mapState } from "pinia";
import Skeleton from '../Components/Skeleton.vue';
export default {
    components: { Link, SearchBar, Skeleton },
    data: () => ({
        order_track_show: false
    }),
    created: async function () {

        await this.check_is_auth();
        await this.get_all_website_settings();
        await this.get_all_website_navbar_menu();

        if (this.is_auth) {
            this.get_all_cart_data();
        }

    },
    methods: {
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
        }),
    },
};
</script>

<style>
.order-track {
    position: relative;
}

.order-track form input {
    background-color: rgba(141, 139, 139, 0.267);
}

.order-track form {
    position: absolute;
    top: 28px;
    left: 0;
    z-index: 99;
}
</style>
