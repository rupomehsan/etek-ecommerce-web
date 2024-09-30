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
        <section class="category_page_header" v-if="query_param == 'search'">
            <div class="custom-container">
                <div v-if="categories?.data?.length">
                    <h5 class="my-2">Catregories</h5>
                    <ul class="page_sub_category_lists">
                        <li
                            v-for="category in categories?.data"
                            :key="category.id"
                        >
                            <Link :href="`/category/${category.slug}`">{{
                                category.title
                            }}</Link>
                        </li>
                    </ul>
                </div>

                <div v-if="brands?.data?.length">
                    <h5 class="my-2 mt-4">Brands</h5>
                    <ul class="page_sub_category_lists">
                        <li v-for="brand in brands?.data" :key="brand.id">
                            <Link :href="`/brand/${brand.slug}`">{{
                                brand.title
                            }}</Link>
                        </li>
                    </ul>
                </div>
            </div>
        </section>

        <section class="section-big-pt-space ratio_asos b-g-light">
            <div class="collection-wrapper" bo>
                <div class="custom-container">
                    <div class="row">
                        <div
                            class="col-sm-3 collection-filter category-page-side"
                        >
                            <div
                                class="collection-filter-block filter_varient_group creative-card creative-inner category-side"
                            >
                                <div class="collection-mobile-back">
                                    <span class="filter-back">
                                        <i
                                            class="fa fa-angle-left"
                                            aria-hidden="true"
                                        ></i>
                                        back
                                    </span>
                                </div>

                                <PriceRange />
                                <template v-if="preloader">
                                    <skeleton
                                        :width="`300px`"
                                        :height="`100vh`"
                                    ></skeleton>
                                </template>
                                <BrandVarients v-else />

                                <AllVarients />
                            </div>
                        </div>
                        <div class="collection-content col">
                            <div class="page-main-content">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div
                                            class="top-banner-wrapper mb-2"
                                           v-if="query_param !== 'search'"
                                        >
                                            <skeleton
                                                v-if="preloader"
                                                :width="`100%`"
                                                :height="`300px`"
                                            ></skeleton>
                                            <img
                                                v-else-if="category.image"
                                                :src="
                                                    load_image(category?.image)
                                                "
                                                style="max-height: 200px"
                                                class="img-fluid"
                                                :alt="category?.title"
                                            />
                                            <img
                                                v-else
                                                src="/dummy.png"
                                                class="img-fluid border"
                                                style="
                                                    max-height: 200px;
                                                    width: 100%;
                                                "
                                            />
                                        </div>
                                        <div class="top-bar ws-box">
                                            <div class="row">
                                                <div
                                                    class="col-sm-4 col-xs-2 actions"
                                                >
                                                    <button
                                                        class="tool-btn"
                                                        id="lc-toggle"
                                                    >
                                                        <i
                                                            class="fa fa-filter"
                                                        ></i>
                                                        Filter
                                                    </button>
                                                    <label
                                                        class="page-heading m-hide"
                                                    >
                                                        {{ queryParam }}
                                                    </label>
                                                </div>
                                                <div
                                                    class="col-sm-8 col-xs-10 show-sort"
                                                >
                                                    <div
                                                        class="form-group rs-none"
                                                    >
                                                        <label>Show:</label>
                                                        <div
                                                            class="custom-select"
                                                        >
                                                            <select
                                                                id="input-limit"
                                                                v-model="limit"
                                                                @change="
                                                                    set_limit(
                                                                        $event
                                                                            .target
                                                                            .value
                                                                    )
                                                                "
                                                            >
                                                                <option
                                                                    value="20"
                                                                    selected="selected"
                                                                >
                                                                    20
                                                                </option>
                                                                <option
                                                                    value="24"
                                                                >
                                                                    24
                                                                </option>
                                                                <option
                                                                    value="48"
                                                                >
                                                                    48
                                                                </option>
                                                                <option
                                                                    value="75"
                                                                >
                                                                    75
                                                                </option>
                                                                <option
                                                                    value="90"
                                                                >
                                                                    90
                                                                </option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Sort By:</label>
                                                        <div
                                                            class="custom-select"
                                                        >
                                                            <select
                                                                id="input-sort"
                                                                @change="
                                                                    set_sort(
                                                                        $event
                                                                            .target
                                                                            .value,
                                                                        'price'
                                                                    )
                                                                "
                                                            >
                                                                <option
                                                                    value="asc"
                                                                >
                                                                    Default
                                                                </option>
                                                                <option
                                                                    value="desc"
                                                                >
                                                                    Price (Low
                                                                    &gt; High)
                                                                </option>
                                                                <option
                                                                    value="asc"
                                                                >
                                                                    Price (High
                                                                    &gt; Low)
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
                                                    <product-card-skeleton
                                                        v-for="i in 30"
                                                        :key="i"
                                                    ></product-card-skeleton>
                                                </template>
                                                <div
                                                    v-else
                                                    class="product_list"
                                                    :class="{
                                                        product_left:
                                                            products.data
                                                                ?.length < 5,
                                                    }"
                                                >
                                                    <template
                                                        v-if="
                                                            products?.data
                                                                ?.length
                                                        "
                                                    >
                                                        <div
                                                            v-for="i in products.data"
                                                            :key="i.id"
                                                        >
                                                            <ProductItem
                                                                :product="i"
                                                            />
                                                        </div>
                                                    </template>
                                                    <template v-else>
                                                        <p
                                                            class="p-3 alert-danger text-center text-danger"
                                                        >
                                                            No Products Found
                                                        </p>
                                                    </template>
                                                </div>
                                            </div>
                                            <div class="product-pagination">
                                                <div
                                                    class="theme-paggination-block"
                                                >
                                                    <div class="row">
                                                        <div
                                                            class="col-xl-6 col-md-6 col-sm-12"
                                                        >
                                                            <nav
                                                                aria-label="Page navigation"
                                                            >
                                                                <ul
                                                                    class="pagination"
                                                                >
                                                                    <li
                                                                        class="page-item"
                                                                        :class="{
                                                                            active: link.active,
                                                                        }"
                                                                        v-for="(
                                                                            link,
                                                                            index
                                                                        ) in products.links"
                                                                        :key="
                                                                            index
                                                                        "
                                                                    >
                                                                        <a
                                                                            :href="
                                                                                link.url
                                                                            "
                                                                            @click.prevent="
                                                                                load_product(
                                                                                    link.url
                                                                                )
                                                                            "
                                                                            class="page-link text_no_wrap"
                                                                        >
                                                                            <span
                                                                                v-html="
                                                                                    link.label
                                                                                "
                                                                            ></span>
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </nav>
                                                        </div>
                                                        <div
                                                            class="col-xl-6 col-md-6 col-sm-12"
                                                        >
                                                            <div
                                                                class="product-search-count-bottom"
                                                            >
                                                                <h5>
                                                                    Showing
                                                                    Products
                                                                    {{
                                                                        products.from
                                                                    }}
                                                                    -
                                                                    {{
                                                                        products.to
                                                                    }}
                                                                    of
                                                                    {{
                                                                        products.total
                                                                    }}
                                                                    Result
                                                                </h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div
                                                class="card"
                                                v-if="
                                                    category.page_full_description
                                                "
                                            >
                                                <div class="card-body">
                                                    <h3
                                                        class="page_full_description_title"
                                                        v-if="
                                                            category.page_full_description_title
                                                        "
                                                    >
                                                        {{
                                                            category.page_full_description_title
                                                        }}
                                                    </h3>
                                                    <div
                                                        class="page_full_description"
                                                        v-html="
                                                            category.page_full_description
                                                        "
                                                    ></div>
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

import BreadCumb from "../../Components/BreadCumb.vue";
import { product_store } from "./Store/product_store.js";
import { mapActions, mapState } from "pinia";

import Skeleton from "../../Components/Skeleton.vue";
import ProductCardSkeleton from "../../Components/Skeliton/ProductCardSkeleton.vue";

export default {
    components: {
        Layout,
        PriceRange,
        BrandVarients,
        AllVarients,
        ProductItem,
        BreadCumb,
        Skeleton,
        ProductCardSkeleton,
    },
    props: ["page"],

    data: () => ({
        queryParam: "",
    }),

    created: async function () {
        const queryString = window.location.search;
        const urlParams = new URLSearchParams(queryString);

        if (urlParams.has("search")) {
            this.queryParam = urlParams.get("search");
            this.set_query_param("search");
            this.set_search_key(this.queryParam);
            await this.global_search();
        } else if (urlParams.has("category")) {
            this.queryParam = urlParams.get("category");
            this.set_slug(this.queryParam);
            this.set_query_param("category");
            await this.get_products_by_category_id();
        } else if (urlParams.has("top-offer")) {
            this.queryParam = urlParams.get("top-offer");
            this.set_slug(this.queryParam);
            this.set_query_param("top-offer");
            await this.get_all_top_offer_products_by_offer_id();
        } else if (urlParams.has("category-group")) {
            this.queryParam = urlParams.get("category-group");
            this.set_slug(this.queryParam);
            this.set_query_param("category-group");
            await this.get_all_products_and_single_group_by_category_group_id();
        } else {
            console.log("No relevant query parameters found.");
        }
    },

    methods: {
        load_image: window.load_image,

        ...mapActions(product_store, {
            global_search: "global_search",
            get_products_by_category_id: "get_products_by_category_id",
            get_all_top_offer_products_by_offer_id:
                "get_all_top_offer_products_by_offer_id",
            get_all_products_and_single_group_by_category_group_id:
                "get_all_products_and_single_group_by_category_group_id",

            get_product_category_varients: "get_product_category_varients",
            get_product_category_wise_brands:
                "get_product_category_wise_brands",
            get_min_max_price: "get_min_max_price",

            load_product: "load_product",

            set_bread_cumb: "set_bread_cumb",
            set_limit: "set_limit",
            set_search_key: "set_search_key",
            set_sort: "set_sort",
            set_slug: "set_slug",
            set_query_param: "set_query_param",
        }),

        toggle_list: function () {
            $(this.$refs.items).slideToggle();
        },
    },

    computed: {
        ...mapState(product_store, {
            products: "products",
            categories: "categories",
            category: "category",
            brands: "brands",
            advertise: "advertise",
            childrens: "childrens",
            bread_cumb: "bread_cumb",
            variant_values_id: "variant_values_id",
            brand_id: "brand_id",
            preloader: "preloader",
            query_param: "query_param",
            limit: "limit",
        }),
    },
};
</script>


<style></style>
