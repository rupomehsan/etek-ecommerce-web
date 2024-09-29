<template>
    <div id="cart_side" class="add_to_cart right">
        <a href="javascript:void(0)" class="overlay" onclick="closeCart()"></a>
        <div class="cart-inner">
            <div class="cart_top">
                <h3>my cart</h3>
                <div class="close-cart">
                    <a href="javascript:void(0)" onclick="closeCart()">
                        <i class="fa fa-times" aria-hidden="true"></i>
                    </a>
                </div>
            </div>
            <div class="cart_media">
                <ul class="cart_product">
                    <li v-for="cart in all_cart_data" :key="cart.id">
                        <div class="media">
                            <Link :href="`/product-details/${cart?.product?.slug}`" class="dummy-image-render">
                            <img class="me-3" :src="load_image(`${cart.product.product_image?.url}`)" />
                            </Link>
                            <div class="media-body">
                                <Link :href="`/product-details/${cart?.product?.slug}`">
                                <h4>{{ cart?.product?.title }}</h4>
                                </Link>
                                <h6 class="d-flex gap-1">
                                    <p>
                                        {{ get_price(cart?.product).new_price }} ৳
                                    </p>
                                    <p class="text-decoration-line-through text-secondary">
                                        {{ get_price(cart?.product).old_price }} ৳
                                    </p>

                                </h6>
                                <div class="addit-box">
                                    <div class="qty-box">
                                        <div class="input-group">
                                            <button class="qty-minus" @click="
                        cart_quantity_update(
                            cart.id,
                            'minus',
                            null
                        )
                        "></button>
                                            <input class="qty-adj form-control" type="number" min="1"
                                                v-model="cart.quantity" @keyup="
                        cart_quantity_update(
                            cart.id,
                            null,
                            $event.target.value
                        )
                        " />
                                            <button class="qty-plus" @click="
                        cart_quantity_update(
                            cart.id,
                            'plus',
                            null
                        )
                        "></button>
                                        </div>
                                    </div>
                                    <div class="pro-add">
                                        <a href="javascript:void(0)" data-bs-toggle="modal"
                                            data-bs-target="#edit-product">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-edit">
                                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7">
                                                </path>
                                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z">
                                                </path>
                                            </svg>
                                        </a>
                                        <a href="javascript:void(0)" @click="remove_cart_item(cart.id)">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-trash-2">
                                                <polyline points="3 6 5 6 21 6"></polyline>
                                                <path
                                                    d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                </path>
                                                <line x1="10" y1="11" x2="10" y2="17"></line>
                                                <line x1="14" y1="11" x2="14" y2="17"></line>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
                <ul class="cart_total">

                    <li>
                        <div class="total">
                            total<span> {{ total_cart_price }} ৳</span>
                        </div>
                    </li>
                    <li>
                        <div class="buttons">
                            <Link href="/cart" class="btn btn-solid btn-sm">view cart
                            </Link>
                            <Link href="/checkout" class="btn btn-solid btn-sm">checkout</Link>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>
<script>
import { mapActions, mapState } from "pinia";
import { common_store } from "../../Store/common_store";
import { auth_store } from "../../Store/auth_store";

export default {

    data: () => ({
        user_type: 'customer'
    }),

    methods: {

        ...mapActions(common_store, {
            get_all_cart_data: "get_all_cart_data",
            remove_cart_item: "remove_cart_item",
            cart_quantity_update: "cart_quantity_update",
        }),
        load_image: window.load_image,

    },

    computed: {

        ...mapState(common_store, {
            all_cart_data: "all_cart_data",
            total_cart_price: "total_cart_price",
            get_price: "get_price",
        }),

        ...mapState(auth_store, {
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

<style>
.dummy-image-render {
    background-image: url('/dummy.png');
    height: 40px;
    width: 80px;
    background-repeat: no-repeat;
    background-size: contain;
}
</style>
