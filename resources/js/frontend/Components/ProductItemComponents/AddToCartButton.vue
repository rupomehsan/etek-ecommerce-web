<template lang="">
    <div>
        <button @click="add_to_cart(product)" title="add to cart"
            class="tooltip-left add_to_cart_button" tabindex="0">

            <div class="cart_icon">
                <span v-if="is_in_cart(product)?.status" class="add_to_cart_button_qty">
                    {{ is_in_cart(product)?.qty }}
                </span>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="feather feather-shopping-cart">
                    <circle cx="9" cy="21" r="1"></circle>
                    <circle cx="20" cy="21" r="1"></circle>
                    <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                </svg>
            </div>

        </button>
    </div>
</template>
<script>
import { mapActions, mapState } from 'pinia';
import { cart_store } from '../../Store/cart_store';
export default {
    components: {},
    props: {
        product: {
            required: true,
            type: Object,
        }
    },
    methods: {
        ...mapActions(cart_store, [
            "add_to_cart",
            "is_in_cart",
        ])
    },
    computed: {
        ...mapState(cart_store, [
            "carts"
        ]),
    }
}
</script>
<style lang="">

</style>
