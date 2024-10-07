<template>
    <div class="product">
        <div class="product-box">
            <div class="product-imgbox">
                <div class="product-front">
                    <Link :href="`/product-details/${product.slug}`">
                    <img :src="load_image(`${product.product_image?.url}`, true, true)
                        " class="img-fluid" />
                    </Link>
                    <buy-now-button :product="product" />
                </div>
                <div class="product-icon">
                    <AddToCartButton :product="product" v-if="product.is_available" />

                    <a @click="is_auth ? add_to_wish_list(product.id) : openAccount()" href="javascript:void(0)"
                        title="add to wish list" class="add-to-wish tooltip-left" data-tippy-content="Add to Wishlist"
                        tabindex="0">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-heart">
                            <path
                                d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z">
                            </path>
                        </svg>
                    </a>
                    <a @click="is_auth ? add_to_compare_list(product.id) : openAccount()" title="add to compare list"
                        class="tooltip-left" data-tippy-content="Compare" tabindex="0">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-refresh-cw">
                            <polyline points="23 4 23 10 17 10"></polyline>
                            <polyline points="1 20 1 14 7 14"></polyline>
                            <path d="M3.51 9a9 9 0 0 1 14.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0 0 20.49 15"></path>
                        </svg>
                    </a>
                </div>
                <div class="new-label" v-if="product.is_new">
                    <div>new</div>
                </div>
                <div class="on-sale" v-if="product.current_discount_price > 0">
                    save {{ product.current_discount_price }} ৳
                </div>
            </div>
            <div class="product-detail">
                <div class="detail-title">
                    <div class="detail-left">
                        <Link :href="`/product-details/${product.slug}`">
                        <h6 class="price-title">
                            {{ product.title.substring(0, 50) }}
                        </h6>
                        </Link>
                    </div>

                    <div class="detail-right" v-if="product.is_available">
                        <template v-if="product.current_discount_price">
                            <div class="price">
                                {{ product.current_discount_price }} ৳
                            </div>
                            <div class="check-price">
                                {{ product.current_price }} ৳
                            </div>
                        </template>
                        <template v-else>
                            <div class="price">
                                {{ product.current_price }} ৳
                            </div>
                        </template>
                    </div>

                    <div v-else class="out-of-stock text-center text-black fw-bold border py-2">
                        Unavailable
                    </div>

                </div>
            </div>
        </div>
        <div class="clear-fix"></div>
    </div>
</template>
<script>

import { mapActions, mapState } from "pinia";
import { common_store } from '../Store/common_store';
import { auth_store } from '../Store/auth_store';
import AddToCartButton from "./ProductItemComponents/AddToCartButton.vue";
import BuyNowButton from "./ProductItemComponents/BuyNowButton.vue";
export default {
    components: {
        AddToCartButton,
        BuyNowButton,
    },
    props: ["product"],

    data: () => ({
        user_type: 'customer'
    }),

    created: async function () {

    },

    methods: {
        load_image: window.load_image,
        check_image_url: function (url) {
            try {
                new URL(url);
                return url;
            } catch (e) {
                return "/" + url;
            }
        },
        ...mapActions(common_store, {
            get_all_cart_data: "get_all_cart_data",
            add_to_cart: "add_to_cart",
            add_to_wish_list: "add_to_wish_list",
            add_to_compare_list: "add_to_compare_list",
            get_price: "get_price",
        }),

        openAccount() {
            document.getElementById("myAccount").classList.add('open-side');
        },

        buyNow: async function (productId) {
            const response = await window.privateAxios(`/add-to-cart`, 'post',
                {
                    product_id: productId,
                }
            );
            this.$inertia.get(`/checkout`);
        }

    },
    computed: {
        ...mapState(auth_store, {
            "is_auth": "is_auth",
            "auth_info": "auth_info",
        }),
    },
    watch: {
        is_auth: {
            handler: function () {
                if (this.is_auth) {
                    this.user_type = this.auth_info?.role?.name ?? 'customer';
                }
            },
            immediate: true,
        },
    },


};
</script>
