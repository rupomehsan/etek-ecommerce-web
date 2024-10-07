<template>
    <section class="section_gap">
        <div class="custom-container">
            <div class="top_categries">
                <carousel :breakpoints="breakpoints" :pauseAutoplayOnHover="true" :autoplay="3000" :wrapAround="true"
                    :transition="500">
                    <slide v-for="(item, index) in all_category_groups" :key="index">
                        <div class="category">
                            <Link :href="`/shop/${item.slug}`" class="category_link">
                            <div class="title">
                                <div class="text-content bn">
                                    {{ item.title }}
                                </div>
                            </div>
                            <img :src="load_image(item.image, true)" />
                            </Link>
                        </div>
                    </slide>
                    <!-- <template #addons>
                        <navigation />
                        <pagination />
                    </template> -->
                </carousel>
            </div>
        </div>
    </section>
</template>

<script>
import { use_home_page_store } from '../../Store/home_page_store.js';
import { mapState } from 'pinia';
import Skeleton from '../../../../Components/Skeleton.vue';
import { Carousel, Slide, Pagination, Navigation } from 'vue3-carousel';
export default {
    components: {
        Skeleton,
        Carousel,
        Slide,
        Pagination,
        Navigation,
    },
    data: () => ({
        breakpoints: {
            // 700px and up
            0: {
                itemsToShow: 2,
                snapAlign: 'center',
            },
            // 1024 and up
            1024: {
                itemsToShow: 4,
                snapAlign: 'start',
            },
        },
    }),
    methods: {
        load_image: window.load_image,
    },
    computed: {
        ...mapState(use_home_page_store, {
            all_category_groups: 'all_category_groups',
            all_top_products_offer: 'all_top_products_offer',
            preloader: 'preloader',
        })
    }
}
</script>

<style></style>
