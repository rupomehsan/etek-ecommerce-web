<template>
    <Layout>
        <div class="breadcrumb-main ">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="breadcrumb-contain">
                            <div>
                                <h2>checkout</h2>
                                <ul>
                                    <li><a href="/">home</a></li>
                                    <li><i class="fa fa-angle-double-right"></i></li>
                                    <li><a href="javascript:void(0)">checkout</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <section class="section-big-py-space b-g-light">
            <div class="custom-container">
                <div class="checkout-page contact-page">
                    <div class="checkout-form">
                        <form @submit.prevent="checkoutFormSubmit($event)">
                            <div class="row">
                                <div class="col-12">
                                    <div class="guest_order_alert"
                                            style="
                                                background: #e4e4e4;
                                                padding: 5px;
                                                border-radius: 5px;
                                                margin-bottom: 17px;"
                                        v-if="!auth_info">
                                        <div class="row align-items-center">
                                            <div class="col-lg-6">
                                                <p class="m-0">Have any account?</p>
                                            </div>
                                            <div class="col-lg-6 text-end">
                                                <Link href="/login" class="btn btn-sm btn-info">Login</Link> &nbsp;
                                                <Link href="/register" class="btn btn-sm btn-primary">Register</Link>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <personal-info />
                                    <delivery-address />
                                </div>
                                <div class="col-lg-8">
                                    <div class="checkout-details theme-form ">
                                        <div class="order-box">
                                            <div class="checkout-title text-center">
                                                <h3>Products</h3>
                                                <hr>
                                            </div>
                                            <cart-items />
                                        </div>
                                    </div>
                                    <div class="checkout-details theme-form  ">
                                        <checkout-action />
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

    </Layout>
</template>

<script>
import axios from "axios";
import Layout from "../../Shared/Layout.vue";
import { mapActions, mapState } from "pinia";
import { common_store } from "../../Store/common_store";
import { cart_store } from '../../Store/cart_store';

import CartItems from "./components/CartItems.vue";
import CheckoutAction from "./components/CheckoutAction.vue";
import DeliveryAddress from "./components/DeliveryAddress.vue";
import PersonalInfo from "./components/PersonalInfo.vue";
import { router } from '@inertiajs/vue3'

export default {
    components: {
        Layout,
        CartItems,
        CheckoutAction,
        DeliveryAddress,
        PersonalInfo,
    },
    data: () => ({}),

    created: async function () { },

    methods: {
        ...mapActions(cart_store, [
            'empty_cart',
            'send_order_email',
        ]),
        checkoutFormSubmit: async function ($event) {
            let formData = new FormData($event.target);
            formData.append('cart_items', JSON.stringify(this.carts));
            let response = await window.privateAxios('/customer-ecommerce-order-placed', 'post', formData);
            if (response.status === "success") {
                this.send_order_email(response.data.order_id, document.querySelector('input[name="email"]').value);
                if (response.data?.payment_method === 'cod') {
                    this.empty_cart();
                    window.s_alert(response.message);
                    router.visit(`/invoice?order_id=${response.data.order_id}&status=success`);
                } else if (response.data?.payment_method === 'online') {
                    this.checkoutPopUp(response.data.order_id);
                }
            }
        },

        checkoutPopUp: async function (order_id) {
            let payment_res = await window.axios.get(`pay-via-ajax?order_id=${order_id}`);
            this.payment_link = payment_res.data?.data;
            window.location.href = this.payment_link;
            // window.open(this.payment_link, "_blank");
        }
    },

    watch: {},

    computed: {
        ...mapState(common_store, {
            all_cart_data: "all_cart_data",
            total_cart_price: "total_cart_price",
            website_settings_data: "website_settings_data",
        }),

        ...mapState(cart_store, [
            'carts'
        ])
    },
};
</script>
