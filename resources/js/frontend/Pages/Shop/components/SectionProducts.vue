<template lang="">
    <div class="shop_category_section_heading mt-4 ">
        <div v-if="category.category?.banner_image">
            <img :src="load_image(category.category?.banner_image)" class="w-100"/>
        </div>
        <h2 class="section_heading">
            <div>
                {{ category.category?.title }} Products
            </div>

            <Link class="section_heading_button" :href="`/products/${category.category?.slug}`">
                More {{ category.category?.title }} Products
                <i class="fa fa-angle-right"></i>
            </Link>
        </h2>
    </div>
    <div class="mb-5">
        <div class="product_list">
            <template v-for="product in category.products" :key="product.id">
                <ProductItem :product="product"/>
            </template>
        </div>
    </div>
</template>
<script>
import { mapWritableState } from 'pinia';
import ProductItem from '../../../Components/ProductItem.vue';
import { shop_store } from '../store/shop_store'
export default {
    components: {
        ProductItem,
    },
    props: [
        "category",
    ],
    computed: {
        ...mapWritableState(shop_store, [
            "featured_category_products"
        ])
    }
}
</script>
<style lang="">

</style>
