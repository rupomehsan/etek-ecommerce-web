<template lang="">
    <div class="custom-container">
        <div class="heighlight_products">
            <div class="heighlight_product_list" >
                <h2 class="heading has_after">New Arrival </h2>
                <div class="product_items">
                    <LeftProductItem v-for="i in all_heighlight_products.new_products" :key="i.id" :product="i"/>
                </div>
            </div>

            <div class="heighlight_product_list" >
                <h2 class="heading has_after">Best Selling </h2>
                <div class="product_items">
                    <LeftProductItem v-for="i in all_heighlight_products.best_selling_products" :key="i.id" :product="i"/>
                </div>
            </div>

            <div class="heighlight_product_list" >
                <h2 class="heading">Tending </h2>
                <div class="product_items">
                    <LeftProductItem v-for="i in all_heighlight_products.trending_products" :key="i.id" :product="i"/>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { mapState } from "pinia";
import LeftProductItem from "../../../Components/LeftProductItem.vue";
import { use_home_page_store } from "../Store/home_page_store";
export default {
    components: {
        LeftProductItem,
    },
    computed: {
        ...mapState(use_home_page_store,[
            "all_heighlight_products"
        ])
    }
}
</script>
<style lang="">

</style>
