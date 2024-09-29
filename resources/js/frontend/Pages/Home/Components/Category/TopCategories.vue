<template>
    <section class="section_gap">
        <div class="custom-container">
            <div class="section_title">
                <h4 class="text">Top Offers</h4>
            </div>
            <div class="d-flex gap-3" v-if="!all_top_products_offer.length">
                <skeleton :height="`200px`" :width="`400px`"></skeleton>
                <skeleton :height="`200px`" :width="`400px`"></skeleton>
                <skeleton :height="`200px`" :width="`400px`"></skeleton>
                <skeleton :height="`200px`" :width="`400px`"></skeleton>
            </div>
            <div class="top_categries" v-else>

                <div class="category" v-for="item in all_top_products_offer" :key="item.id">
                    <Link :href="`offer-products/${item.slug}`" class="category_link">
                    <div class="title"></div>
                    <img :src="load_image(`${item.image}`, true)" :alt="`ETEK Top Offer ${item.slug}`">
                    </Link>
                </div>
                <!-- <div class="category">
                    <Link :href="`offer-products/popular-products`" class="category_link">
                    <div class="title"></div><img src="/frontend/assets/images/popular_products.webp">
                    </Link>
                </div>
                <div class="category">
                    <Link :href="`offer-products/flash-sale`" class="category_link">
                    <div class="title"></div><img src="/frontend/assets/images/flash_sale.webp">
                    </Link>
                </div>
                <div class="category">
                    <Link :href="`offer-products/super-saver`" class="category_link">
                    <div class="title"></div><img src="/frontend/assets/images/super_saver.webp">
                    </Link>
                </div> -->
            </div>
        </div>
        <div class="custom-container">
            <div class="section_title">
                <h4 class="text my-5">Top Categories</h4>
            </div>
            <div class="d-flex gap-3" v-if="!all_category_groups.length">
                <skeleton :height="`200px`" :width="`400px`"></skeleton>
                <skeleton :height="`200px`" :width="`400px`"></skeleton>
                <skeleton :height="`200px`" :width="`400px`"></skeleton>
                <skeleton :height="`200px`" :width="`400px`"></skeleton>
            </div>
            <div class="top_categries" v-else>
                <div v-for="(item, index) in all_category_groups" :key="index" class="category">
                    <Link :href="`/category-group/${item.slug}`" class="category_link">
                    <div class="title"> {{ item.title }}</div>
                    <img :src="load_image(item.image, true)" :alt="`ETEK Top Category ${item.title}`" />
                    </Link>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import { use_home_page_store } from '../../Store/home_page_store.js';
import { mapState } from 'pinia';
import Skeleton from '../../../../Components/Skeleton.vue';
export default {
    components: { Skeleton },
    data: () => ({

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
