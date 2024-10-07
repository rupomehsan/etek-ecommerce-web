<template>
    <Layout>

        <Head>
            <title>{{ slug }} Price in Bangladesh</title>
        </Head>
        <div class="breadcrumb-main py-3">
            <div class="custom-container">
                <BreadCumb :bread_cumb="bread_cumb" />
            </div>
        </div>

        <section class="section-big-pt-space ratio_asos b-g-light">
            <div class="collection-wrapper">
                <div class="custom-container">
                    <div class="row">
                        <div class="collection-content col">
                            <div class="page-main-content">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="top-banner-wrapper mb-2">
                                            <skeleton v-if="preloader" :width="`100%`" :height="`300px`"></skeleton>
                                            <img v-else-if="brand.image" :src="load_image(brand?.image)"
                                                class="img-fluid" :alt="brand?.title">
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
                                                        {{ brand.title }}
                                                    </label>
                                                </div>
                                                <div class="col-sm-8 col-xs-10 show-sort">
                                                    <div class="form-group rs-none">
                                                        <label>Show:</label>
                                                        <div class="custom-select">
                                                            <select id="input-limit">
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
                                                                            @click.prevent="get_products_by_brand_id(link.url)"
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

import ProductItem from "../../Components/ProductItem.vue";

import BreadCumb from '../../Components/BreadCumb.vue';
import { brand_store } from "./Store/brand_store.js"
import { mapActions, mapState } from 'pinia';

import Skeleton from '../../Components/Skeleton.vue';
import ProductCardSkeleton from '../../Components/Skeliton/ProductCardSkeleton.vue';

export default {
    components: { Layout, ProductItem, BreadCumb, Skeleton, ProductCardSkeleton },
    props: ['slug', 'page'],

    data: () => ({
        preloader: true,
    }),

    setup(props) {
        let use_brand_store = brand_store();
        use_brand_store.slug = props.slug;
    },

    created: async function () {
        await this.get_products_by_brand_id();
        this.preloader = false
    },
    methods: {

        load_image: window.load_image,
        ...mapActions(brand_store, {
            get_products_by_brand_id: "get_products_by_brand_id",
        }),

        toggle_list: function () {
            $(this.$refs.items).slideToggle();
        },
    },

    computed: {
        ...mapState(brand_store, {
            products: 'products',
            brand: 'brand',
            bread_cumb: 'bread_cumb',
        })
    },


};

</script>


<style></style>
