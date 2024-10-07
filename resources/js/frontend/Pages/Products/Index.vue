<template>
    <Layout>

        <Head>
            <title>{{ category.title }} Price in Bangladesh</title>
        </Head>

        <div class="breadcrumb-main py-3" v-if="window_width >= 575">
            <div class="custom-container">
                <BreadCumb :bread_cumb="bread_cumb" />
            </div>
        </div>

        <section class="category_page_header" v-if="window_width >= 575 && (category.page_header_title || childrens?.length)">
            <div class="custom-container">
                <h2 class="page_header_title" v-if="category.page_header_title">
                    {{ category.page_header_title }}
                </h2>
                <div class="page_header_description" v-if="category.page_header_description"
                    v-html="category.page_header_description"></div>
                <ul class="page_sub_category_lists">
                    <li v-for="sub in childrens" :key="sub.id">
                        <Link :href="`/products/${sub.slug}`">
                        {{ sub.title }}
                        </Link>
                    </li>
                </ul>
            </div>
        </section>

        <section class="section-big-pt-space ratio_asos b-g-light">
            <div class="collection-wrapper">
                <div class="custom-container">
                    <div class="row">
                        <!--  banner -->
                        <!-- <div class="col-12">
                            <div class="top-banner-wrapper mb-2">
                                <page-banner />
                            </div>
                        </div> -->

                        <!-- left filter -->
                        <div class="col-lg-3 collection-filter category-page-side" id="filter_card">
                            <div
                                class="collection-filter-block filter_varient_group creative-card creative-inner category-side">
                                <div class="collection-mobile-back" onclick="document.getElementById('filter_card').classList.toggle('active')">
                                    <span class="filter-back">
                                        <i class="fa fa-angle-left" aria-hidden="true"></i>
                                        back
                                    </span>
                                </div>
                                <PriceRange />
                                <BrandVarients/>
                                <AllVarients />
                            </div>
                        </div>

                        <!-- contents -->
                        <div class="collection-content col-lg-9">
                            <div class="page-main-content">
                                <div class="row">

                                    <div class="col-sm-12 category_filter_col">
                                        <div class="top-bar ws-box">
                                            <div class="row">
                                                <div class="col-sm-4 col-xs-2 actions">
                                                    <label class="page-heading m-hide">
                                                        {{ category.title }}
                                                    </label>
                                                </div>
                                                <div class="col-sm-8 col-xs-10 show-sort">
                                                    <div class="form-group">
                                                        <label class="rs-none">Show:</label>
                                                        <div class="custom-select">
                                                            <select id="input-limit" v-model="paginate">
                                                                <option value="32" selected="selected">30</option>
                                                                <option value="56">50</option>
                                                                <option value="112">100</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="form-group d-lg-none" onclick="document.getElementById('filter_card').classList.toggle('active')">
                                                        <div class="custom-select">
                                                            Filter
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="rs-none">Sort By:</label>
                                                        <div class="custom-select">
                                                            <select id="input-sort" v-model="priceOrderByType">
                                                                <option value="ASC">Default</option>
                                                                <option value="ASC">
                                                                    Price (Low &gt; High)
                                                                </option>
                                                                <option value="DESC">
                                                                    Price (High &gt; Low)
                                                                </option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 product_category_list_col">

                                        <div class="collection-product-wrapper">

                                            <div class="py-4">
                                                <div class="product_list"
                                                    :class="{ product_left: products.data?.length < 2 }">
                                                    <div v-for="i in products.data" :key="i.id">
                                                        <ProductItem :product="i" />
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="product-pagination">
                                                <div class="theme-paggination-block">
                                                    <div class="row">
                                                        <div class="col-xl-6 col-md-6 col-sm-12">
                                                            <nav aria-label="Page navigation">
                                                                <ul class="pagination">
                                                                    <li class="page-item"
                                                                        :class="{ active: link.active }"
                                                                        v-for="(link, index) in products.links"
                                                                        :key="index">
                                                                        <a :href="link.url"
                                                                            @click.prevent="load_product(link)"
                                                                            class="page-link text_no_wrap">
                                                                            <span v-html="link.label"></span>
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </nav>
                                                        </div>
                                                        <div class="col-xl-6 col-md-6 col-sm-12">
                                                            <div class="product-search-count-bottom">
                                                                <h5>
                                                                    Showing Products {{ products.from }} -
                                                                    {{ products.to }} of {{ products.total }}
                                                                    Result
                                                                </h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="card" v-if="category.page_full_description">
                                                <div class="card-body">
                                                    <h3 class="page_full_description_title" v-if="category.page_full_description_title">
                                                        {{ category.page_full_description_title }}
                                                    </h3>
                                                    <div class="page_full_description" v-html="category.page_full_description"></div>
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
            <div class="py-2"></div>
        </section>
    </Layout>
</template>

<script>
import Layout from "../../Shared/Layout.vue";
import PriceRange from "./CategoryVarients/PriceRange.vue";
import BrandVarients from "./CategoryVarients/BrandVarients.vue";
import AllVarients from "./CategoryVarients/AllVarients.vue";
import ProductItem from "../../Components/ProductItem.vue";

import BreadCumb from '../../Components/BreadCumb.vue';
import { product_store } from "./Store/product_store.js"
import { mapActions, mapState, mapWritableState } from 'pinia';

import Skeleton from '../../Components/Skeleton.vue';
import ProductCardSkeleton from '../../Components/Skeliton/ProductCardSkeleton.vue';

import PageBanner from "./Components/PageBanner.vue";

import debounce from 'debounce'

export default {
    components: {
        Layout, PriceRange, BrandVarients,
        AllVarients, ProductItem, BreadCumb,
        Skeleton, ProductCardSkeleton,
        PageBanner,
    },
    props: [
        'slug',
        'page',
        'data',
    ],

    data: () => ({
        preloader: true
    }),

    setup(props) {
        let use_product_store = product_store();
        use_product_store.slug = props.slug;
    },

    created: function () {
        this.set_page(this.page);
        if (this.data?.products) {
            this.set_category_data(this.data);
        }
    },

    mounted: async function () {
        // await this.get_products_by_category_id();
        this.set_bread_cumb();
        this.get_product_category_wise_brands(this.slug);
        this.get_product_category_varients(this.slug);
    },
    methods: {
        ...mapActions(product_store, {
            get_products_by_category_id: "get_products_by_category_id",
            get_product_category_varients: "get_product_category_varients",
            get_product_category_wise_brands: "get_product_category_wise_brands",
            load_product: "load_product",
            set_bread_cumb: "set_bread_cumb",
            get_min_max_price: "get_min_max_price",
            set_category_data: "set_category_data",
            set_page: "set_page",
        }),

        toggle_list: function () {
            $(this.$refs.items).slideToggle();
        },
    },

    computed: {
        ...mapWritableState(product_store, {
            products: 'products',
            category: 'category',
            advertise: 'advertise',
            childrens: 'childrens',
            bread_cumb: 'bread_cumb',
            variant_values_id: 'variant_values_id',
            brand_id: 'brand_id',
            preloader: true,
            priceOrderByType: "priceOrderByType",
            paginate: "paginate",
        }),
        window_width: () => window.innerWidth,
    },

    watch: {
        paginate: function(){
            this.get_products_by_category_id();
        },
        priceOrderByType: function(){
            this.get_products_by_category_id();
        },
        variant_values_id: {
            handler: function () {
                this.get_products_by_category_id();
            },
            deep: true
        },
        brand_id: {
            handler: function () {
                this.get_products_by_category_id();
            },
            deep: true
        },
        products(newVal) {
            if (newVal) {
                this.preloader = false;
            }
        },
    }

};

</script>


<style></style>
