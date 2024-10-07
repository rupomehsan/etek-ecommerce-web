<template>
    <div class="left_product_item">
        <div class="image">
            <Link :href="`/product-details/${product.slug}`">
                <img :src="load_image(product.product_image?.url)" />
            </Link>
        </div>
        <div class="info">
            <Link :href="`/product-details/${product.slug}`">
                <h4 class="product_title">
                    {{ product.title }}
                </h4>
                <div v-if="product.product_manufaturer">
                    {{ product.product_manufaturer.title }}
                </div>
                <div class="price" v-if="product.current_discount_price">
                    <div class="new">
                        {{number_format(product.current_discount_price)}} ৳
                    </div>
                    <div class="old">
                        {{number_format(product.current_price)}} ৳
                    </div>
                </div>
                <div class="price" v-else>
                    <div class="new">
                        {{number_format(product.current_price)}} ৳
                    </div>
                </div>
            </Link>
            <div>
                <button class="cart_btn btn" @click.prevent="add_to_cart(product)">
                    <i class="fa fa-shopping-cart"></i>
                    Add To Cart <span v-if="is_in_cart(product).status">( {{ is_in_cart(product).qty }} )</span>
                </button>
            </div>
        </div>
    </div>
</template>
<script>
import { mapActions, mapState } from "pinia";
import {cart_store} from "../Store/cart_store";
export default {
    props: ["product"],
    methods: {
        ...mapActions(cart_store, [
            "add_to_cart",
            "is_in_cart",
        ])
    },
    computed: {
        ...mapState(cart_store,[
            "carts"
        ]),
    }
}
</script>
