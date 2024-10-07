<template lang="">
    <div>
        <div v-if="carts.length" class="payment-box">
            <div class="upper-box">
                <div class="payment-options">
                    <ul>

                        <li>
                            <div class="radio-option">
                                <input type="radio" v-model="payment_type"
                                    name="payment_type" value="cod"
                                    id="payment-cod">
                                <label for="payment-cod">
                                    Cash On Delivery
                                </label>
                            </div>
                        </li>

                        <li>
                            <div class="radio-option paypal">
                                <input type="radio" v-model="payment_type"
                                    value="online" name="payment_type"
                                    id="payment-online">
                                <label for="payment-online">
                                    Online Payment
                                </label>
                            </div>
                        </li>

                    </ul>
                </div>
            </div>
            <div class="text-right">
                <div>
                    <label>
                        <input type="checkbox" value="1" checked required class="form-checkinput" name="agree_with_terms"/>
                        I have read and agree to the Terms and Conditions, Privacy Policy & Refund and Return Policy.
                    </label>
                </div>
                <button type="submit" class="btn-normal btn">Place Order</button>
            </div>
        </div>

        <div v-else class="text-center">
            <h3 class="my-3">No product in cart</h3>
            <Link href="/" class="btn-normal btn">Continue shopping</Link>
        </div>
    </div>
</template>
<script>
import { cart_store } from '../../../Store/cart_store';
import { mapState } from "pinia";
export default {
    data: () => ({
        payment_type: 'cod',
    }),
    computed: {
        ...mapState(cart_store, [
            "carts",
        ])
    }
}
</script>
<style lang="">

</style>
