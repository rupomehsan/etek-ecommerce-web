<template>
    <section class="discount-banner">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="discount-banner-contain">
                        <h2>Featured Products</h2>
                        <h1>
                            every <span> discount </span> we
                            <span> offer is the best in market!</span>
                        </h1>
                        <div class="rounded-contain">
                            <div class="rounded-subcontain">
                                don't just scroll, your friends have already
                                started buying!
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="my-5 py-5">
        <div class="custom-container">
            <template v-if="!feature_products.length">
                <product-card-skeleton v-for="i in 30" :key="i"></product-card-skeleton>
            </template>
            <template v-else>
                <div class="product_list">
                    <div v-for="product in feature_products" :key="product.name">
                        <ProductItem :product="product" />
                    </div>
                </div>
            </template>
        </div>
    </section>

</template>

<script>

import ProductItem from "../../../Components/ProductItem.vue";
import { use_home_page_store } from "../Store/home_page_store.js";
import { mapState } from "pinia";

import ProductCardSkeleton from '../../../Components/Skeliton/ProductCardSkeleton.vue';
export default {
    components: {
        ProductItem,
        ProductCardSkeleton,
    },
    data: () => ({
        preloader: true
    }),
    created: async function () {
        if (this.feature_products.length) {
            this.preloader = false;
        }
    },
    computed: {
        ...mapState(use_home_page_store, {
            feature_products: "feature_products",
        }),
    },
    watch: {
        feature_products(newVal) {
            if (newVal) {
                this.preloader = false;
            }
        },
    },
};
</script>
