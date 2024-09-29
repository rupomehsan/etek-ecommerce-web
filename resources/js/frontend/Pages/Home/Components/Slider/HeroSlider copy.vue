<template>
    <section class="color_bg_banner">
        <div class="custom-container">
            <div class="website_banner">
                <div class="left" id="banner_left">
                    <!-- <skeleton v-if="preloader.side_nav_category" :width="`100%`" :height="`720px`"></skeleton> -->
                    <left-category-list></left-category-list>
                </div>
                <!-- <div v-if="preloader.banner" class="right">
                    <div class="d-flex gap-1">
                        <div class="w-80">
                            <skeleton :width="`100%`" :height="`440px`"></skeleton>
                        </div>
                        <div class="w-20">
                            <skeleton :width="`100%`" :height="`440px`"></skeleton>
                        </div>
                    </div>
                    <div class="d-flex gap-1 my-2">
                        <div class="w-40">
                            <skeleton :width="`100%`" :height="`270px`"></skeleton>
                        </div>
                        <div class="w-40">
                            <skeleton :width="`100%`" :height="`270px`"></skeleton>
                        </div>
                        <div class="w-20">
                            <skeleton :width="`100%`" :height="`270px`"></skeleton>
                        </div>
                    </div>
                </div> -->

                <div class="right">
                    <div class="top_banner">
                        <div class="top_banner_left">
                            <slider></slider>
                            <!--
                                <Suspense>
                                    <template #default>
                                        <LazyComponent />
                                    </template>
                                        <template #fallback>
                                        <div>
                                            <skeleton :width="100" :height="440"></skeleton>
                                        </div>
                                    </template>
                                </Suspense>
                            -->
                        </div>
                        <div class="top_banner_right">
                            <img :src="`${load_image(home_hero_slider_side_banner.banner_one, true)}`"
                                alt="headphone collection" class="w-100" />
                            <!-- <div class="offer-banner-img">
                                <img src="https://themes.pixelstrap.com/bigdeal/assets/images/layout-1/offer-banner.png" alt="offer-banner" class="img-fluid" />
                            </div>
                            <div class="banner-contain">
                                <div>
                                    <a href="product-page(left-sidebar).html">
                                        <h5>Special Offer for you</h5>
                                        <div class="discount-offer">
                                            <h1>50%</h1>
                                            <sup>off</sup>
                                        </div>
                                    </a>
                                </div>
                            </div> -->
                        </div>
                    </div>

                    <!-- <div class="bottom_banner">
                        <div class="bottom_banner_left">
                            <div class="img">
                                <img :src="`${load_image(home_hero_slider_side_banner.banner_two, true)}`"
                                    alt="gadget collection" />
                            </div>
                            <div class="img">
                                <img :src="`${load_image(home_hero_slider_side_banner.banner_three, true)}`"
                                    alt="watch collection" />
                            </div>
                        </div>
                        <div class="bottom_banner_right">
                            <div class="img">
                                <img :src="`${load_image(home_hero_slider_side_banner.banner_four, true)}`"
                                    alt="camera collection" />
                            </div>
                        </div>
                    </div> -->
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
export default {
    components: {
        Skeleton,
        Carousel,
        Slide,
        Slider,
        Pagination,
        Navigation,
        LeftCategoryList,
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
        }),
    },

};
</script>
