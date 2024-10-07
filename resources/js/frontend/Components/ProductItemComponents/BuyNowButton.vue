<template lang="">
    <a v-if="product.is_available" @click.prevent="buy_now(product)"
        class="buy_now_btn c-pointer">
        <i class="icon-shopping-cart icon"></i>
        Buy Now
    </a>
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
            "buy_now",
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
