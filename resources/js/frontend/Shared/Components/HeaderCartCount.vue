<template lang="">
    <div class="cart">
        <button href="#" class="btn p-0" onclick="event.preventDefault(); openCart()">
            <img src="/icons/cart.png" />
            <div class="cart_count">
                {{ carts?.length }}
            </div>
        </button>
    </div>
</template>
<script>
import { mapState } from "pinia";
import { cart_store } from "../../Store/cart_store"
export default {
    computed: {
        ...mapState(cart_store,[
            "carts"
        ])
    }
}
</script>
<style lang="">

</style>
