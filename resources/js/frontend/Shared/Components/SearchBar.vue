<template>

    <div class="input-box header_search_area">
        <form class="hungry_coder-form" :action="`/search-results?search_key=${search_key}`">
            <div class="input-group ">
                <div class="input-group-text">
                    <span class="search"><i class="fa fa-search"></i></span>
                </div>
                <input type="search" name="search_key" v-model="search_key" class="form-control"
                    placeholder="Search a Product">
            </div>
        </form>
        <div v-if="!is_in_search_page && search_key.length" class="search_results">
            <div class="search_types">
                <ul>
                    <li>
                        <a href="#" @click.prevent="search_type = 'products'"
                            :class="{ active: search_type == 'products', }">Products</a>
                    </li>
                    <li>
                        <a href="#" @click.prevent="search_type = 'categories'"
                            :class="{ active: search_type == 'categories', }">
                            Categories
                        </a>
                    </li>
                    <li>
                        <a href="#" @click.prevent="search_type = 'brand'" :class="{ active: search_type == 'brand', }">
                            Brand
                        </a>
                    </li>
                    <!-- <li>
                        <a href="#" @click.prevent="search_type = 'tag'" :class="{ active: search_type == 'tag', }">
                            Tag
                        </a>
                    </li> -->
                </ul>
            </div>

            <div class="search_items">
                <div v-if="preloader">
                    <search-result-skeleton></search-result-skeleton>
                </div>
                <template v-else>
                    <div class="products" v-if="search_type == 'products'">
                        <template v-if="search_data.product?.data?.length">
                            <div class="search_item" v-for="product in search_data.product.data" :key="product.id">
                                <a @click.prevent="visit_product(`/product-details/${product.slug}`)"
                                    :href="`/product-details/${product.slug}`">
                                    <div class="left dummy-image-render">
                                        <img :src="load_image(`${product.product_image?.url}`)" alt="img">
                                    </div>
                                    <div class="right">
                                        <h3 class="product_title">
                                            {{ product.title }}
                                        </h3>
                                        <div v-if="product.is_available" class="price">
                                            <div class="old">
                                                {{ get_price(product)?.old_price }}৳
                                            </div>
                                            <div class="new">
                                                {{ get_price(product)?.new_price }}৳
                                            </div>
                                        </div>
                                        <div v-else>
                                            stock out
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </template>
                        <template v-else>
                            <p class="alert alert-info">No item found in search</p>
                        </template>

                    </div>
                    <div class="categories" v-if="search_type == 'categories'">
                        <template v-if="search_data.category?.data?.length">
                            <div class="search_item" v-for="category in search_data.category.data" :key="category.id">
                                <Link :href="`/category/${category.slug}`">
                                <div class="left">
                                    <img :src="`/${category.image}`" alt="img">
                                </div>
                                <div class="right">
                                    <h3 class="product_title">
                                        {{ category.title }}
                                    </h3>
                                </div>
                                </Link>
                            </div>
                        </template>
                        <template v-else>
                            <p class="alert alert-info">No item found in search</p>
                        </template>
                    </div>
                    <div class="categories" v-if="search_type == 'brand'">
                        <template v-if="search_data.brand?.data?.length">
                            <div class="search_item" v-for="brand in search_data.brand?.data" :key="brand.id">
                                <Link :href="`/brand/${brand.slug}`">
                                <div class="left">
                                    <img :src="`/${brand.image}`" alt="img">
                                </div>
                                <div class="right">
                                    <h3 class="product_title">
                                        {{ brand.title }}
                                    </h3>
                                </div>
                                </Link>
                            </div>
                        </template>
                        <template v-else>
                            <p class="alert alert-info">No item found in search</p>
                        </template>
                    </div>
                    <div class="categories" v-if="search_type == 'tag'">
                        <template v-if="search_data.tag?.length">
                            <div class="search_item" v-for="tag in search_data.tag" :key="tag.id">
                                <a href="#">
                                    <div class="left">
                                        <img :src="`/${tag.image}`" alt="">
                                    </div>
                                    <div class="right">
                                        <h3 class="product_title">
                                            {{ tag.title }}
                                        </h3>
                                    </div>
                                </a>
                            </div>
                        </template>
                        <template v-else>
                            <p class="alert alert-info">No item found in search</p>
                        </template>
                    </div>
                </template>


            </div>
            <div class="search_action">
                <Link :href="`/search-results?search_key=${search_key}`" :preserve-state="true" :preserve-scroll="true">
                See all results
                </Link>
            </div>
        </div>
    </div>

</template>

<script>
import { ref, watch, computed } from 'vue';

import { use_global_search_store } from "../../Pages/GlobalSearchResult/Store/global_search_store.js"
import { common_store } from "../../Store/common_store";
import { router } from '@inertiajs/vue3';
import { mapActions } from 'pinia';
import SearchResultSkeleton from '../../Components/Skeliton/SearchResultSkeleton.vue';

export default {
    components: { SearchResultSkeleton },

    setup() {
        const preloader = ref(true);
        const global_search_store = use_global_search_store();
        const search_data = computed(() => global_search_store.search_result_data);
        const search_key = ref(global_search_store.search_key);
        const searchTimer = ref(null);
        watch(search_key, (newVal) => {
            clearTimeout(searchTimer.value);
            preloader.value = true; // Set preloader to true before starting the search
            searchTimer.value = setTimeout(async () => {
                global_search_store.search_key = newVal;
                await global_search_store.global_search();
                preloader.value = false; // Set preloader to false after the search is done
            }, 1000);
        });

        return {
            preloader,
            search_data,
            search_key
        };

    },
    data: () => ({
        search_type: 'products',
        // search_key: '',

    }),
    methods: {

        ...mapActions(use_global_search_store, ['reset_search']),
        ...mapActions(common_store, { get_price: "get_price" }),

        load_image: window.load_image,
        visit_product: function (url) {
            router.get(url);
            this.reset_search();
        }
    },
    created: function () {
        // console.log(window.location.pathname);
    },
    computed: {
        is_in_search_page: function () {
            let path = window.location.pathname;
            return path.includes('search-results')
        }
    }

    // watch: {
    //     search_key(newVal) {
    //         clearTimeout(this.searchTimer);
    //         this.searchTimer = setTimeout(async () => {
    //             const global_search_store = use_global_search_store();
    //             await global_search_store.global_search(newVal);
    //         }, 1000);
    //     },
    // },

}
</script>

<style>
.left {
    background-image: url('/dummy.png');
    height: 40px;
    width: 80px;
    background-repeat: no-repeat;
    background-size: contain;
    background-color: white;

}
</style>
