<template>
    <Layout>
        <div class="breadcrumb-main py-3">
            <div class="custom-container">
                <BreadCumb :bread_cumb="bread_cumb" />
            </div>
        </div>
        <section class="category_page_header">
            <div class="custom-container">
                <div v-if="search_result?.category?.data?.length">
                    <h5 class="my-2">Catregory</h5>
                    <ul class="page_sub_category_lists">
                        <li v-for="category in search_result?.category?.data" :key="category.id">
                            <Link :href="`/category/${category.slug}`">{{ category.title }}</Link>
                        </li>
                    </ul>
                </div>

                <div v-if="search_result?.brand?.data?.length">
                    <h5 class="my-2 mt-4">Brands</h5>
                    <ul class="page_sub_category_lists">
                        <li v-for="brand in search_result?.brand?.data" :key="brand.id">
                            <Link :href="`/brand/${brand.slug}`">{{ brand.title }}</Link>
                        </li>
                    </ul>
                </div>
            </div>
        </section>
        <section class="section-big-pt-space ratio_asos b-g-light">
            <div class="collection-wrapper">
                <div class="custom-container">
                    <div class="row">

                        <div class="collection-content col">
                            <div class="page-main-content">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="top-bar ws-box">
                                            <div class="row">
                                                <div class="col-sm-4 col-xs-2 actions">
                                                    <label class="page-heading m-hide">Search Results</label>
                                                </div>
                                                <div class="col-sm-8 col-xs-10 show-sort"></div>
                                            </div>
                                        </div>
                                        <div class="collection-product-wrapper">
                                            <div class="py-5">
                                                <div class="product_list product_left">
                                                    <div v-for="product in search_result?.product?.data"
                                                        :key="product.id">
                                                        <ProductItem :product="product" />
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="product-pagination" v-if="search_result?.product?.data?.length">
                                                <div class="theme-paggination-block">
                                                    <div class="row">
                                                        <div class="col-xl-6 col-md-6 col-sm-12">
                                                            <nav aria-label="Page navigation">
                                                                <ul class="pagination">
                                                                    <li class="page-item"
                                                                        :class="{ active: link.active }"
                                                                        v-for="(link, index) in search_result?.product?.links"
                                                                        :key="index">
                                                                        <a :href="link.url"
                                                                            @click.prevent="global_search(link.url)"
                                                                            class="page-link text_no_wrap">
                                                                            <span v-html="link.label"></span>
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </nav>
                                                        </div>
                                                        <div class="col-xl-6 col-md-6 col-sm-12">
                                                            <div class="product-search-count-bottom">
                                                                <h5>Showing Products
                                                                    {{
                                                                    search_result?.product?.from
                                                                    }}
                                                                    -{{
                                                                        search_result?.product?.to
                                                                    }}
                                                                    of
                                                                    {{
                                                                        search_result?.product?.total
                                                                    }}
                                                                    Result
                                                                </h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="py-4">
                <!-- {{ search_result }} -->
            </div>
        </section>
    </Layout>
</template>

<script>
import Layout from "../../Shared/Layout.vue";
import BreadCumb from '../../Components/BreadCumb.vue';

import { use_global_search_store } from "./Store/global_search_store.js"

import ProductItem from "../../Components/ProductItem.vue";
import { mapActions, mapState, mapWritableState } from 'pinia';

export default {
    components: { Layout, ProductItem, BreadCumb },
    data: () => ({
        bread_cumb: [
            {
                title: 'Seacrh Result',
                url: '#',
                active: false,
            },
        ],
    }),
    created: async function () {
        let url = window.location.href;
        url = new URL(url);
        let key = url.searchParams.get('search_key');
        this.set_search_key(key);
        this.global_search();
    },
    methods: {
        ...mapActions(use_global_search_store, [
            'set_search_key',
            'global_search',
            'reset_search',
        ])
    },
    computed: {
        ...mapState(use_global_search_store, {
            search_result: 'search_result_data'
        }),
        ...mapWritableState(use_global_search_store, {
            search_key: 'search_key'
        }),
    },
    beforeUnmount: function () {
        this.reset_search();
    }
};
</script>


<style scoped>
.product_list.product_left {
    grid-template-columns: repeat(auto-fit, minmax(87px, 240px)) !important;
}
</style>
