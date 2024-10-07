<template>
    <div class="breadcrumb-main py-3">
        <div class="custom-container">
            <BreadCumb :bread_cumb="bread_cumb" />
        </div>
    </div>
    <section class="section-big-pt-space b-g-light">
        <div class="collection-wrapper">
            <div class="custom-container">
                <div class="container-fluid">
                    <ProductBasicInfo :product="product_initial_data"></ProductBasicInfo>
                </div>
                <ProductBottomDetails :product="product_details"></ProductBottomDetails>
            </div>
        </div>
    </section>
</template>
<script>

import Layout from "../../Shared/Layout.vue";
import { useProductDetailsStore } from './Store/product_details_store.js';
import ProductBasicInfo from './Components/ProductBasicInfo.vue';
import ProductBottomDetails from './Components/ProductBottomDetails.vue';
import TopProducts from './Components/TopProducts.vue';
import { mapActions, mapState, mapWritableState } from 'pinia';
import ProductImage from './Components/ProductImage.vue';
import BreadCumb from '../../Components/BreadCumb.vue';

export default {
    components: { BreadCumb, Layout, ProductBasicInfo, ProductBottomDetails, TopProducts, ProductImage },
    props: {
        slug: String,
    },
    data: () => ({
        loaded: false,
        product: null,
        bread_cumb: [
            {
                title: 'product-details',
                url: '#',
                active: false,
            },
        ],
    }),
    created: async function () {
        // console.log(this.slug);
    },


    computed: {
        ...mapWritableState(useProductDetailsStore, {
            product_details: 'product_details',
            product_initial_data: 'product_initial_data',
        })
    }


};
</script>

<style scoped>
/* Add your styles here */
</style>
