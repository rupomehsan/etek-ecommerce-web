<template>
    <Layout>
        <Head>
            <title>ETEK Enterprise - Leading Electronics and Gadgets</title>
        </Head>

        <HeroSlider />

        <BreakingNews />

        <TopCategories />

        <OurServiceType />

        <FeaturedProducts />

        <Brands />

        <JoinNewsLetter />

        <BottomDescription />
    </Layout>

</template>
<script>
import Layout from "../../Shared/Layout.vue";
import HeroSlider from "./Components/Slider/HeroSlider.vue";
import BreakingNews from "./Sections/BreakingNews.vue";
import TopCategories from "./Components/Category/TopCategories.vue";
import OurServiceType from "../../Components/OurServiceType.vue";
import FeaturedProducts from "./Sections/FeaturedProducts.vue";
import BottomDescription from "./Sections/BottomDescription.vue";
import Brands from "./Sections/Brands.vue";
import JoinNewsLetter from "./Sections/JoinNewsLetter.vue";

import { mapActions, mapState, mapWritableState } from 'pinia';
import {use_home_page_store} from "./Store/home_page_store";
import {common_store} from "../../Store/common_store";

export default {
    props: [
        'hero_slider',
        'hero_side_slider',
        'settings',
        'left_nave_category',
    ],
    components: {
        Layout,
        HeroSlider,
        BreakingNews,
        TopCategories,
        OurServiceType,
        FeaturedProducts,
        BottomDescription,
        Brands,
        JoinNewsLetter,
    },

    created: async function () {


        this.home_hero_sliders = this.hero_slider;
        this.home_hero_slider_side_banner = this.hero_side_slider;

        let that = this;
        that.get_all_home_hero_sliders();
        that.get_home_slider_side_banner();
        that.get_all_top_products_offer();
        that.get_all_category_groups();
        that.get_all_brands();
        that.get_all_featured_products();
    },

    methods: {
        ...mapActions(use_home_page_store,{
            get_all_home_hero_sliders: "get_all_home_hero_sliders",
            get_home_slider_side_banner: "get_all_home_slider_side_banners",
            get_all_top_products_offer: "get_all_top_products_offer",
            get_all_category_groups: "get_all_category_groups",
            get_all_featured_products: "get_all_featured_products",
            get_all_brands: "get_all_brands",
        })
    },
    computed: {
        ...mapWritableState(use_home_page_store, [
            'home_hero_sliders',
            'home_hero_slider_side_banner',
        ]),
        ...mapWritableState(common_store, [
            'website_settings_data',
        ])
    }
};
</script>
<style lang="scss" scoped></style>
