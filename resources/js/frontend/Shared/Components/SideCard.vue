<template>
    <div id="cart_side" class="add_to_cart right">
        <a href="javascript:void(0)" class="overlay" onclick="closeCart()"></a>
        <div class="cart-inner">
            <div class="cart_top">
                <h3>
                    CART
                    <span style="font-size: 13px;">
                        ({{ carts.length }} Items)
                    </span>

                </h3>
                <div class="close-cart">
                    <a href="javascript:void(0)" onclick="closeCart()">
                        <i class="fa fa-times" aria-hidden="true"></i>
                    </a>
                </div>
            </div>
            <div class="cart_media cart_scroll">
                <table class="w-100">
                    <tbody>
                        <tr v-for="cart in carts" :key="cart.product_id" class="sidebar_cart_item_tr">
                            <td style="width: 50px; vertical-align: top;">
                                <i @click="delete_item(cart)" class="fa fa-trash btn btn-sm btn-outline-danger"></i>
                            </td>
                            <td>
                                <div class="side_cart_item">

                                    <h5 class="side_cart_product_title">{{ cart.title }}</h5>

                                    <img class="me-3" :src="load_image(`${cart?.product_image?.url}`)"
                                        style="height: 50px;width: 50px;" />

                                    <div class="d-flex align-items-center cart_quantity_wraper">
                                        <div class="cart_current_price">
                                            {{ number_format(cart.final_price) }} ৳
                                        </div>
                                        <div>
                                            <i class="fa fa-close"></i>
                                        </div>
                                        <div class="cart_qty_updater">
                                            <button class="btn" @click="
                                                add_to_cart(
                                                    cart,
                                                    cart.qty - 1,
                                                )
                                                ">
                                                <i class="fa fa-minus"></i>
                                            </button>
                                            <input type="text" :value="cart.qty" @keyup="validate_number(cart)">
                                            <button class="btn" @click="
                                                add_to_cart(
                                                    cart,
                                                    cart.qty + 1,
                                                )
                                                ">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="text-end side_bar_last_child">
                                <div class="active_price">
                                    {{ number_format(cart.qty * (cart.final_price)) }} ৳
                                </div>

                            </td>
                        </tr>
                    </tbody>
                </table>
                <ul class="cart_total">
                    <li>
                        <div class="total">
                            <Link href="/checkout" class="btn btn-solid btn-sm">checkout</Link>
                            <span> {{ number_format(total_price) }} ৳</span>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>
<script>
import { mapActions, mapState, mapGetters } from "pinia";
import { cart_store } from "../../Store/cart_store";

export default {
    data: () => ({
        user_type: 'customer'
    }),
    methods: {
        load_image: window.load_image,
        ...mapActions(cart_store, [
            "add_to_cart",
            "delete_item",
        ]),
        validate_number: function (cart) {
            let input = event.target.value;
            let cleanedInput = input.replace(/[a-zA-Z]/g, '');
            const isValidNumber = !isNaN(cleanedInput) && cleanedInput.trim() !== '';

            if (isValidNumber) {
                if (cleanedInput < 1) cleanedInput = 1;
                cart.qty = parseInt(cleanedInput);
                event.target.value = parseInt(cleanedInput)
            } else {
                cart.qty = 1;
                event.target.value = 1
            }
        }
    },
    computed: {
        ...mapGetters(cart_store, [
            "total_price",
        ]),
        ...mapState(cart_store, [
            "carts",
        ])
    },
};
</script>
