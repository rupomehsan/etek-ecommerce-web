<template>
    <Layout>
        <!-- <Head>
            <title>ETEK Enterprise - Leading Electronics and Gadgets</title>
        </Head> -->

        <HeroSlider />

        <TopCategories />

        <AllFeaturedCategories />

        <!-- <OurServiceType /> -->

        <HeighLightProducts />

        <FeaturedProducts />

        <!-- <Brands /> -->

        <JoinNewsLetter />

        <BottomDescription />
    </Layout>

</template>
<script>
import Layout from "../../Shared/Layout.vue";
import HeroSlider from "./Components/Slider/HeroSlider.vue";
import TopCategories from "./Components/Category/TopCategories.vue";
import AllFeaturedCategories from "./Components/Category/AllFeaturedCategories.vue";
import OurServiceType from "../../Components/OurServiceType.vue";
import FeaturedProducts from "./Sections/FeaturedProducts.vue";
import BottomDescription from "./Sections/BottomDescription.vue";
import Brands from "./Sections/Brands.vue";
import JoinNewsLetter from "./Sections/JoinNewsLetter.vue";
import HeighLightProducts from "./Sections/HeighLightProducts.vue";

import { mapActions, mapState, mapWritableState } from 'pinia';
import {use_home_page_store} from "./Store/home_page_store";
import {common_store} from "../../Store/common_store";

export default {
    props: [
        'hero_slider',
        'hero_side_slider',
        'settings',
        'left_nave_category',
        'category_group',
        'all_featured_products',
        'all_featured_categories',
        'heighlight_products',
    ],

    created: async function () {
        this.side_nav_categories = this.left_nave_category;
        this.home_hero_sliders = this.hero_slider;
        this.home_hero_slider_side_banner = this.hero_side_slider;
        this.all_category_groups = this.category_group;
        this.feature_products = this.all_featured_products;
        this.home_featured_categories = this.all_featured_categories;
        this.all_heighlight_products = this.heighlight_products;
    },

    methods: {
        ...mapActions(use_home_page_store,{})
    },

    computed: {
        ...mapWritableState(use_home_page_store, [
            'home_hero_sliders',
            'home_hero_slider_side_banner',
            'side_nav_categories',
            'all_category_groups',
            'feature_products',
            'home_featured_categories',
            'all_heighlight_products',
        ]),
        ...mapWritableState(common_store, [
            'website_settings_data',
        ])
    },
    components: {
        Layout,
        HeroSlider,
        TopCategories,
        OurServiceType,
        FeaturedProducts,
        BottomDescription,
        Brands,
        JoinNewsLetter,
        AllFeaturedCategories,
        HeighLightProducts,
    },

};
</script>
<style lang="scss" scoped></style>
