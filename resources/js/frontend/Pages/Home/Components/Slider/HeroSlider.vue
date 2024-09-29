<template>
    <section class="color_bg_banner">
        <div class="custom-container">
            <div class="website_banner">
                <div class="left" id="banner_left" v-if="preloader.side_nav_category">
                    <side-category-skeleton></side-category-skeleton>
                </div>
                <div class="left" id="banner_left" v-else>
                    <left-category-list></left-category-list>
                </div>
                <div class="right" v-if="preloader.banner">
                    <home-banner-skeleton></home-banner-skeleton>
                </div>
                <div class="right" v-else>
                    <div class="top_banner">
                        <div class="top_banner_left">
                            <slider></slider>
                        </div>
                        <div class="top_banner_right">
                            <img :src="bannerImage(home_hero_slider_side_banner.banner_one)" alt="headphone collection"
                                class="w-100" />
                        </div>
                    </div>

                    <div class="bottom_banner">
                        <div class="bottom_banner_left">
                            <div class="img">
                                <img :src="bannerImage(home_hero_slider_side_banner.banner_two)"
                                    alt="gadget collection" />
                            </div>
                            <div class="img">
                                <img :src="bannerImage(home_hero_slider_side_banner.banner_three)"
                                    alt="watch collection" />
                            </div>
                        </div>
                        <div class="bottom_banner_right">
                            <div class="img">
                                <img :src="bannerImage(home_hero_slider_side_banner.banner_four)"
                                    alt="camera collection" />
                            </div>
                        </div>
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
import { Carousel, Slide, Pagination, Navigation } from 'vue3-carousel';
import LeftCategoryList from '../Category/LeftCategoryList.vue';
import { mapState } from 'pinia';
import { use_home_page_store } from '../../Store/home_page_store.js';
import HomeBannerSkeleton from '../../../../Components/Skeliton/HomeBannerSkeleton.vue';
import SideCategorySkeleton from '../../../../Components/Skeliton/SideCategorySkeleton.vue';

export default {
    components: {
        Carousel,
        Slide,
        Slider: defineAsyncComponent(() => import('./Slider.vue')),
        Pagination,
        Navigation,
        LeftCategoryList,
        HomeBannerSkeleton,
        SideCategorySkeleton,
    },
    methods: {
        load_image: window.load_image,
        bannerImage(banner) {
            return this.load_image(banner, true);
        },
        check_image_url(url) {
            try {
                new URL(url);
                return url;
            } catch (e) {
                return url.replace(/\/{2,}/g, '/');
            }
        },
    },
    computed: {
        ...mapState(use_home_page_store, {
            home_hero_slider_side_banner: 'home_hero_slider_side_banner',
            preloader: 'preloader',
            side_nav_categories: 'side_nav_categories',
        }),
    },
    created() {
        console.log('Banner loaded');
    },
};
</script>
