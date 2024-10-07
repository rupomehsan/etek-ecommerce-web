<template>
    <section class="category_page_banners">
        <carousel :breakpoints="breakpoints" :pauseAutoplayOnHover="true" :autoplay="1000" :wrapAround="true" :transition="500">
            <slide v-for="item in images" :key="item">
                <div class="category_page_banner_item">
                    <img :src="load_image(item)">
                </div>
            </slide>
            <!-- <template #addons>
                <navigation />
                <pagination />
            </template> -->
        </carousel>
    </section>
</template>
<script>

import { mapState } from 'pinia';
import { Carousel, Slide, Pagination, Navigation } from 'vue3-carousel';

export default {
    components: {
        Carousel,
        Slide,
        Pagination,
        Navigation,
    },

    data: () => ({
        images: [
            "uploads/category_page_banners/1.jpg",
            "uploads/category_page_banners/2.jpg",
            "uploads/category_page_banners/3.jpg",
            "uploads/category_page_banners/4.jpg",
        ],
        breakpoints: {
            // 700px and up
            0: {
                itemsToShow: 1,
                snapAlign: 'center',
            },
            // 1024 and up
            1024: {
                itemsToShow: 1,
                snapAlign: 'start',
            },
        },

    }),
    methods: {

    },

    computed: {

    },
}
</script>

