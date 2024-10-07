<template lang="">
    <Layout>
        <section>
            <div class="custom-container">
                <PageBanners />
            </div>
        </section>
        <section class="mb-5">
            <div class="custom-container">
                <FeaturedCategories />
            </div>
        </section>
        <section>
            <div class="custom-container">
                <template v-for="(s_category, index) in featured_category_products" :key="index">
                    <SectionProducts :category="s_category"/>
                </template>
            </div>
        </section>
    </Layout>
</template>
<script>
import FeaturedCategories from './components/FeaturedCategories.vue';
import SectionProducts from './components/SectionProducts.vue';
import PageBanners from './components/PageBanner.vue';
import Layout from "../../Shared/Layout.vue";
import { shop_store } from './store/shop_store';
import { mapWritableState } from "pinia";
export default {
    props: [
        "page_slug",
        "page_category_group",
        "page_categories",
        "page_featured_category_products",
    ],
    components: {
        PageBanners,
        Layout,
        FeaturedCategories,
        SectionProducts,
    },
    created: function () {
        this.slug = this.page_slug;
        this.category_group = this.page_category_group;
        this.categories = this.page_categories;
        this.featured_category_products = this.page_featured_category_products;
    },
    computed: {
        ...mapWritableState(shop_store, [
            "slug",
            "category_group",
            "categories",
            "featured_categories",
            "featured_category_products",
        ]),
    }
}
</script>
<style lang="">

</style>
