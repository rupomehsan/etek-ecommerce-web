<template>
    <div class="row">
        <div class="col-lg-5">
            <div>
                <product-image :product="product"></product-image>
            </div>
        </div>
        <div class="col-lg-7">
            <div class="single-product-info ps-3">
                <div class="single-product-info-top">
                    <h3 class="single-product-title">
                        {{ product.title }}
                    </h3>
                    <div class="single-product-price display-flex-center mb-24">
                        <div v-if="product.customer_sales_price" class="product-price-widget regular-price">
                            <span class="regular-price-title">Regular price:</span>
                            <span class="regular-main-price">
                                {{ product.customer_sales_price }} BDT
                            </span>
                        </div>
                        <div v-if="product.current_price" class="product-price-widget offer-price">
                            <span class="offer-price-title">Offer price: </span>
                            <span class="offer-main-price">
                                {{ product.current_price }} BDT
                            </span>
                        </div>
                        <span v-if="product.discount_amount" class="product-price-save">
                            -{{ Math.floor(product.discount_amount) }}
                            {{ product.discount_type == 'percent' ? '%' : 'BDT' }} SAVE
                        </span>
                    </div>
                </div>
                <div class="product-core-info-list">
                    <span class="p-core-info-list-title">Status</span>
                    <span v-if="product.is_available" class="p-core-info-list-sub-title stock-in">Stock in</span>
                    <span v-else class="p-core-info-list-sub-title stock-out">Stock Out</span>
                </div>
                <div class="product-core-info-list">
                    <span class="p-core-info-list-title">Sku</span>
                    <span class="p-core-info-list-sub-title product-code">
                        {{ product.sku }}
                    </span>
                </div>
                <div class="product-core-info-list">
                    <span class="p-core-info-list-title">Brand</span>
                    <span class="p-core-info-list-sub-title brand-name">{{ product.product_brand?.title }}</span>
                </div>
                <div class="product-core-info-list">
                    <span class="p-core-info-list-title">Region</span>
                    <span class="p-core-info-list-sub-title region-name" v-if="product.product_region?.length">
                        <template v-for="region in product.product_region" :key="region.id">
                            {{ region?.country?.name }} ,
                        </template>
                    </span>
                    <span class="p-core-info-list-sub-title region-name" v-else>Bangladesh</span>
                </div>

                <div class="short-description" v-html="get_short_description(product.short_description)">

                </div>
                <!-- <color-varient></color-varient> -->
                <!-- <common-varient></common-varient> -->
                <!-- <div class="product-core-info-list">
                    <span class="p-core-info-list-title">Sim</span>
                    <div class="product-sim-system product-storages display-flex-center">
                        <div class="single-sim">
                            <label for="exampleRadios1">
                                <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" />
                                e-Sim
                            </label>
                        </div>
                        <div class="single-sim">
                            <label for="exampleRadios2">
                                <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" />
                                Dual sim
                            </label>
                        </div>
                    </div>
                </div> -->
                <div class="product-core-info-list" v-if="product.warranty">
                    <span class="p-core-info-list-title">Warranty</span>
                    <span class="p-core-info-list-sub-title emi-facility">
                        <span>{{ product.warranty }}</span>
                    </span>
                </div>
            </div>
            <div class="ps-3">
                <h6 class="product-title d-block mt-3">quantity</h6>
                <div class="qty-box">
                    <div class="input-group">
                        <button class="qty-minus" @click="AdujustQuantity('minus')"></button>
                        <input class="qty-adj form-control" type="number" min="1" v-model="quantity" />
                        <button class="qty-plus" @click="AdujustQuantity('plus')"></button>
                    </div>
                </div>
            </div>
            <div class="product-buttons ps-3 d-flex flex-wrap gap-2 mt-4">
                <button @click="add_to_cart(product, +quantity)" class="btn btn-normal">
                    <i class="icon icon-shopping-cart"></i>
                    Add to Cart

                    <span v-if="is_in_cart(product).status" class="d-none">
                        {{ set_default_qty(is_in_cart(product).qty) }}
                        ( {{ is_in_cart(product).qty }} )
                    </span>

                </button>
                <a @click="is_auth ? add_to_wish_list(product.id) : openAccount()"
                    class="btn px-4 btn-normal btn-outline add-to-wish tooltip-top"
                    data-tippy-content="Add to wishlist">
                    <i class="fa fa-heart" aria-hidden="true"></i>
                </a>
            </div>
        </div>
    </div>
</template>

<script>
import ColorVarient from '../Components/ColorVarient.vue'
import CommonVarient from '../Components/CommonVarient.vue'
import ProductImage from '../Components/ProductImage.vue'

import { mapActions, mapState } from "pinia";
import { common_store } from "../../../Store/common_store";
import { cart_store } from '../../../Store/cart_store';

export default {
    components: { ProductImage, ColorVarient, CommonVarient },
    props: {
        product: Object
    },
    data: () => ({
        quantity: 1,
    }),
    created: async function () {
        this.is_auth = localStorage.getItem("token") ? true : false;
    },
    mounted: function () {
    },
    watch: {
        quantity: function (v) {
            this.add_to_cart(this.product, v);
        }
    },
    methods: {
        ...mapActions(common_store, {
            add_to_wish_list: "add_to_wish_list",
        }),

        ...mapActions(cart_store, [
            "add_to_cart",
            "is_in_cart",
        ]),

        AdujustQuantity: function (type) {
            if (type == "plus") {
                this.quantity++;
            } else {
                if (this.quantity > 1) {
                    this.quantity--;
                }
            }
        },

        openAccount() {
            document.getElementById("myAccount").classList.add('open-side');
        },

        set_default_qty: function (qty) {
            this.quantity = qty;
        },

        get_short_description: function (description) {
            try {
                let data = `<ul>`;
                data += JSON.parse(description).map(i => `<li>${i}</li>`).join('');
                data += "</ul";
                return data;
            }
            catch (e) {
                return description;
            }
        }

    },
    computed: {
        ...mapState(cart_store, [
            "carts"
        ])
    }
}
</script>

<style scoped>
.short-description ul {
    display: grid;
    gap: 10px;
}

.short-description ul li {
    font-weight: bold;
}
</style>
