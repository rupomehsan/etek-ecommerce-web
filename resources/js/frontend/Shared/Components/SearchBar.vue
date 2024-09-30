<template>
    <div class="input-box header_search_area">
        <form
            class="hungry_coder-form"
            :action="`/products?search=${search_key}`"
        >
            <div class="input-group">
                <div class="input-group-text">
                    <span class="search"><i class="fa fa-search"></i></span>
                </div>
                <input
                    type="search"
                    name="search"
                    v-model="search_key_local"
                    class="form-control"
                    placeholder="Search a Product"
                />
            </div>
        </form>
        <div
            v-if="!is_in_search_page && search_key_local.length"
            class="search_results"
        >
            <div class="search_types">
                <ul>
                    <li>
                        <a
                            href="#"
                            @click.prevent="search_type = 'products'"
                            :class="{ active: search_type == 'products' }"
                            >Products</a
                        >
                    </li>
                    <li>
                        <a
                            href="#"
                            @click.prevent="search_type = 'categories'"
                            :class="{ active: search_type == 'categories' }"
                        >
                            Categories
                        </a>
                    </li>
                    <li>
                        <a
                            href="#"
                            @click.prevent="search_type = 'brand'"
                            :class="{ active: search_type == 'brand' }"
                        >
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
                        <template v-if="products?.data?.length">
                            <div
                                class="search_item"
                                v-for="product in products.data"
                                :key="product.id"
                            >
                                <a
                                    @click.prevent="
                                        visit_product(
                                            `/product-details/${product.slug}`
                                        )
                                    "
                                    :href="`/product-details/${product.slug}`"
                                >
                                    <div class="left dummy-image-render">
                                        <img
                                            :src="
                                                load_image(
                                                    `${product.product_image?.url}`
                                                )
                                            "
                                            alt="img"
                                        />
                                    </div>
                                    <div class="right">
                                        <h3 class="product_title">
                                            {{ product.title }}
                                        </h3>
                                        <div
                                            v-if="product.is_available"
                                            class="price"
                                        >
                                            <div class="old">
                                                {{
                                                    get_price(product)
                                                        ?.old_price
                                                }}৳
                                            </div>
                                            <div class="new">
                                                {{
                                                    get_price(product)
                                                        ?.new_price
                                                }}৳
                                            </div>
                                        </div>
                                        <div v-else>stock out</div>
                                    </div>
                                </a>
                            </div>
                        </template>
                        <template v-else>
                            <p class="alert alert-info">
                                No item found in search
                            </p>
                        </template>
                    </div>
                    <div class="categories" v-if="search_type == 'categories'">
                        <template v-if="categories?.data?.length">
                            <div
                                class="search_item"
                                v-for="category in categories.data"
                                :key="category.id"
                            >
                                <Link :href="`/category/${category.slug}`">
                                    <div class="left">
                                        <img
                                            :src="`/${category.image}`"
                                            alt="img"
                                        />
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
                            <p class="alert alert-info">
                                No item found in search
                            </p>
                        </template>
                    </div>
                    <div class="categories" v-if="search_type == 'brand'">
                        <template v-if="brands?.data?.length">
                            <div
                                class="search_item"
                                v-for="brand in brands?.data"
                                :key="brand.id"
                            >
                                <Link :href="`/brand/${brand.slug}`">
                                    <div class="left">
                                        <img
                                            :src="`/${brand.image}`"
                                            alt="img"
                                        />
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
                            <p class="alert alert-info">
                                No item found in search
                            </p>
                        </template>
                    </div>
                    <div class="categories" v-if="search_type == 'tag'">
                        <template v-if="tag?.length">
                            <div
                                class="search_item"
                                v-for="tag in tags"
                                :key="tag.id"
                            >
                                <a href="#">
                                    <div class="left">
                                        <img :src="`/${tag.image}`" alt="" />
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
                            <p class="alert alert-info">
                                No item found in search
                            </p>
                        </template>
                    </div>
                </template>
            </div>
            <div class="search_action">
                <Link
                    :href="`/products?search=${search_key}`"
                    :preserve-state="true"
                    :preserve-scroll="true"
                >
                    See all results
                </Link>
            </div>
        </div>
    </div>
</template>

<script>
import { product_store } from "../../Pages/ProductPage/Store/product_store.js";
import { common_store } from "../../Store/common_store";
import { router } from "@inertiajs/vue3";
import { mapActions, mapState } from "pinia";
import SearchResultSkeleton from "../../Components/Skeliton/SearchResultSkeleton.vue";

export default {
    components: { SearchResultSkeleton },

    data: () => ({
        search_type: "products",
        search_key_local: "",
    }),
    methods: {
        ...mapActions(product_store, [
            "reset_search",
            "updateSearchKey",
            "global_search",
        ]),
        ...mapActions(common_store, { get_price: "get_price" }),

        load_image: window.load_image,
        visit_product: function (url) {
            router.get(url);
            this.reset_search();
        },
    },
    created: function () {
        // console.log(window.location.pathname);
    },
    computed: {
        ...mapState(product_store, {
            products: "products",
            search_key: "search_key",
            categories: "categories",
            category: "category",
            brands: "brands",
            preloader: "preloader",
        }),
        is_in_search_page: function () {
            let path = window.location.pathname;
            return path.includes("products");
        },
    },

    watch: {
        search_key_local(newVal) {
            clearTimeout(this.searchTimer);
            this.searchTimer = setTimeout(() => {
                this.updateSearchKey(newVal); // Call the store action to update search_key
                this.global_search(); // Trigger the search API
            }, 500); // 500ms delay
        },
    },
};
</script>

<style>
.left {
    background-image: url("/dummy.png");
    height: 40px;
    width: 80px;
    background-repeat: no-repeat;
    background-size: contain;
    background-color: white;
}
</style>
