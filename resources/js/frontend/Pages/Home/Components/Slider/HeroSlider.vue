<template>
    <section class="color_bg_banner">
        <div class="custom-container">
            <div class="website_banner">
                <div class="left" id="banner_left">
                    <left-category-list></left-category-list>
                </div>
                <div class="right">
                    <slider></slider>
                    <div>
                        <BreakingNews/>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import 'vue3-carousel/dist/carousel.css'
import { defineAsyncComponent } from 'vue';
import Slider from './Slider.vue';
import { Carousel, Slide, Pagination, Navigation } from 'vue3-carousel'
import LeftCategoryList from '../Category/LeftCategoryList.vue';
import { mapState } from 'pinia';
import { use_home_page_store } from '../../Store/home_page_store.js';
import Skeleton from '../../../../Components/Skeleton.vue';
import BreakingNews from "../../Sections/BreakingNews.vue";
export default {
    components: {
        Skeleton,
        Carousel,
        Slide,
        Slider,
        Pagination,
        Navigation,
        LeftCategoryList,
        BreakingNews,
        // LazyComponent: defineAsyncComponent(() =>
        //     import('./Slider.vue')
        // ),

    },
    methods: {
        load_image: window.load_image,
        check_image_url: function (url) {
            try {
                new URL(url);
                return url;
            } catch (e) {
                url = "/cache/" + url;
                url.replaceAll('//', '/');
                return url;
            }
        },
    },

    created: function(){
        console.log('banner');
        // console.log(this.home_hero_slider_side_banner);
    },

    computed: {
        ...mapState(use_home_page_store, {
            home_hero_slider_side_banner: 'home_hero_slider_side_banner',
            preloader: 'preloader',
            side_nav_categories: "side_nav_categories",
        }),
    },

};
</script>
