<template lang="">
    <button type="button" onclick="openCart()" class="cart-active btn btn-primary" data-bs-toggle="offcanvas"
        data-bs-target="#sidebarOffcanvas" aria-controls="sidebarOffcanvas">
        <img class="cart_icon" src="/icons/cart.png"/>
        <p class="cart-active-text">
            {{ carts.length }} items
        </p>
        <!-- <span class="floated_total_cart_amount">৳ 2140</span> -->
    </button>
</template>
<script>
import { mapState } from "pinia";
import { cart_store } from "../../Store/cart_store";
export default {
    computed: {
        ...mapState(cart_store, [
            "carts"
        ])
    }
}
</script>
<style lang="">

</style>
