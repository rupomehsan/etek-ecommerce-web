<template lang="">
    <div class="checkout_cart_table">
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
                                        <div class="btn" @click="
                                            add_to_cart(
                                                cart,
                                                cart.qty - 1,
                                            )
                                            ">
                                            <i class="fa fa-minus"></i>
                                        </div>
                                        <input type="text" :value="cart.qty" @keyup="validate_number(cart)">
                                        <div class="btn" @click="
                                            add_to_cart(
                                                cart,
                                                cart.qty + 1,
                                            )
                                            ">
                                            <i class="fa fa-plus"></i>
                                        </div>
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
        </div>

        <div class="checkout_cart_total">
            <div class="checkout_cart_total_title">Sub Total</div>
            <span class="checkout_cart_total_amount">
                {{ number_format(total_price) }} ৳
            </span>
        </div>
        <div class="checkout_cart_total">
            <div class="checkout_cart_total_title">
                Delivery Cost
                <input name="delivery_charge" :value="delivery_charge" type="hidden" />
            </div>
            <span class="checkout_cart_total_amount">
                <span >
                    {{ delivery_charge }} ৳
                </span>
            </span>
        </div>
        <div class="checkout_cart_total">
            <div class="checkout_cart_total_title">Grand Total</div>
            <span class="checkout_cart_total_amount">
                {{ number_format(total_price + (+delivery_charge) ) }} ৳
            </span>
        </div>

    </div>
</template>
<script>
import { cart_store } from '../../../Store/cart_store';
import { common_store } from '../../../Store/common_store';
import { mapActions, mapState, mapGetters } from 'pinia';
import { check_out_store } from '../store/check_out_store';
export default {
    data: () => ({
        'delivery_charge': 50,
    }),
    watch: {
        is_outside_dhaka: function (v) {
            if (v) {
                this.delivery_charge = this.get_setting_value('delivery_charge', true)[1].value;
            } else {
                this.delivery_charge = this.get_setting_value('delivery_charge', true)[0].value;
            }
        }
    },
    methods: {
        load_image: window.load_image,
        ...mapActions(cart_store, [
            "add_to_cart",
            "delete_item",
        ]),
        ...mapActions(common_store, [
            "get_setting_value",
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
        ]),
        ...mapState(check_out_store, [
            "is_outside_dhaka"
        ])
    }
}
</script>
<style lang="">

</style>
