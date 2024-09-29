<template>
    <Layout>

        <Head>
            <title>{{ category.title }} Price in Bangladesh</title>
        </Head>
        <div class="breadcrumb-main py-3">
            <div class="custom-container">
                <BreadCumb :bread_cumb="bread_cumb" />
            </div>
        </div>
        <section class="category_page_header">
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
                        <div class="col-sm-3 collection-filter category-page-side">

                            <div
                                class="collection-filter-block filter_varient_group creative-card creative-inner category-side">
                                <div class="collection-mobile-back">
                                    <span class="filter-back">
                                        <i class="fa fa-angle-left" aria-hidden="true"></i>
                                        back
                                    </span>
                                </div>

                                <PriceRange />
                                <template v-if="preloader">
                                    <skeleton :width="`300px`" :height="`100vh`"></skeleton>
                                </template>
                                <BrandVarients v-else />

                                <AllVarients />
                            </div>

                        </div>
                        <div class="collection-content col">
                            <div class="page-main-content">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="top-banner-wrapper mb-2">
                                            <skeleton v-if="preloader" :width="`100%`" :height="`300px`"></skeleton>
                                            <img v-else-if="advertise" :src="load_image(advertise?.image)"
                                                class="img-fluid" :alt="advertise?.title">
                                            <img v-else src="/dummy.png" class="img-fluid border"
                                                style="max-height: 200px; width: 100%;">

                                        </div>
                                        <div class="top-bar ws-box">
                                            <div class="row">
                                                <div class="col-sm-4 col-xs-2 actions">
                                                    <button class="tool-btn" id="lc-toggle">
                                                        <i class="fa fa-filter"></i>
                                                        Filter
                                                    </button>
                                                    <label class="page-heading m-hide">
                                                        {{ category.title }}
                                                    </label>
                                                </div>
                                                <div class="col-sm-8 col-xs-10 show-sort">
                                                    <div class="form-group rs-none">
                                                        <label>Show:</label>
                                                        <div class="custom-select">
                                                            <select id="input-limit" @change="setLimit($event.target.value)">
                                                                <option value="20" selected="selected">20</option>
                                                                <option value="24">24</option>
                                                                <option value="48">48</option>
                                                                <option value="75">75</option>
                                                                <option value="90">90</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Sort By:</label>
                                                        <div class="custom-select">
                                                            <select id="input-sort">
                                                                <option value="">Default</option>
                                                                <option value="p.price-ASC">Price (Low &gt; High)
                                                                </option>
                                                                <option value="p.price-DESC">Price (High &gt; Low)
                                                                </option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="collection-product-wrapper">

                                            <div class="py-5">
                                                <template v-if="preloader">
                                                    <product-card-skeleton v-for="i in 30"
                                                        :key="i"></product-card-skeleton>
                                                </template>
                                                <div v-else class="product_list"
                                                    :class="{ product_left: products.data?.length < 5 }">
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
                                                    <h3 class="page_full_description_title"
                                                        v-if="category.page_full_description_title">
                                                        {{ category.page_full_description_title }}
                                                    </h3>
                                                    <div class="page_full_description"
                                                        v-html="category.page_full_description"></div>
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
            <div class="py-4"></div>
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
import { mapActions, mapState } from 'pinia';

import Skeleton from '../../Components/Skeleton.vue';
import ProductCardSkeleton from '../../Components/Skeliton/ProductCardSkeleton.vue';

export default {
    components: { Layout, PriceRange, BrandVarients, AllVarients, ProductItem, BreadCumb, Skeleton, ProductCardSkeleton },
    props: ['slug', 'page'],

    data: () => ({
        preloader: true
    }),

    setup(props) {
        let use_product_store = product_store();
        use_product_store.slug = props.slug;
    },

    created: async function () {
        await this.get_products_by_category_id();
        await this.get_product_category_wise_brands(this.slug);
        await this.get_product_category_varients(this.slug);
        await this.set_bread_cumb();
    },
    methods: {

        load_image: window.load_image,
        ...mapActions(product_store, {
            get_products_by_category_id: "get_products_by_category_id",
            get_product_category_varients: "get_product_category_varients",
            get_product_category_wise_brands: "get_product_category_wise_brands",
            load_product: "load_product",
            set_bread_cumb: "set_bread_cumb",
            get_min_max_price: "get_min_max_price",
            set_limit: "set_limit",
        }),

        toggle_list: function () {
            $(this.$refs.items).slideToggle();
        },
        setLimit(limit) {
            this.set_limit(limit)
        }
    },

    computed: {
        ...mapState(product_store, {
            products: 'products',
            category: 'category',
            advertise: 'advertise',
            childrens: 'childrens',
            bread_cumb: 'bread_cumb',
            variant_values_id: 'variant_values_id',
            brand_id: 'brand_id',
            preloader: true
        })
    },

    watch: {
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
