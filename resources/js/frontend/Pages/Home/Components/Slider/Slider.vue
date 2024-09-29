<template>

    <div class="theme-slider">
        <carousel :items-to-show="1">
            <slide v-for="slider in home_hero_sliders" :key="slider.id">
                <div v-if="slider.image">
                    <div class="slider-banner" style="min-height: 400px;background-image: url('/frontend/assets/images/banners/12.png');background-size:cover ;">
                        <img  :src="`${check_image_url(slider.image, true)}`" alt="top gadgets in bd"
                            class="w-100" />
                    </div>
                </div>
            </slide>
            <!-- <template #addons>
                <navigation />
                <pagination />
            </template> -->
        </carousel>

        <!-- <div>
            <div class="slider-banner">
                <div class="slider-img">
                    <ul class="layout2-slide-3">
                        <li id="img-3"><img src="https://themes.pixelstrap.com/bigdeal/assets/images/layout-1/slider/1.3.png" class="img-fluid" alt="slider" /></li>
                    </ul>
                </div>
                <div class="slider-banner-contain">
                    <div>
                        <h4>march special</h4>
                        <h1>leather bag</h1>
                        <h2>minimum 60% off</h2>
                        <a href="product-page(left-sidebar).html" class="btn btn-normal">Shop Now</a>
                    </div>
                </div>
            </div>
        </div> -->
    </div>
</template>
<script>

import 'vue3-carousel/dist/carousel.css'
import { Carousel, Slide, Pagination, Navigation } from 'vue3-carousel'

import { use_home_page_store } from '../../Store/home_page_store.js';
import { mapState } from 'pinia';
import Skeleton from '../../../../Components/Skeleton.vue';


export default {
    components: {
        Carousel,
        Slide,
        Pagination,
        Navigation,
        Skeleton
    },

    SkeletonSkeletondata: () => ({
        is_loaded: false
    }),

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

    computed: {

        ...mapState(use_home_page_store, {
            home_hero_sliders: 'home_hero_sliders',
        })

    },

};
</script>
