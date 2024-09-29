<template>
    <section class="brands">
        <div class="custom-container">
            <h2 class="title">Brands We Are Working With</h2>
            <ul class="brand_items">
                <li v-for="item in brands" :key="item.id">
                    <Link :href="`/brand/${item.slug}`">
                    <template v-if="item.image">
                        <img :src="check_image_url(item.image)" :alt="item.title">
                    </template>

                    <template v-else>
                        <div class="no-image d-flex align-items-center justify-content-center">
                            {{ item.title }}
                        </div>
                    </template>
                    </Link>

                </li>
            </ul>
        </div>
    </section>
</template>
<script>

import { mapState } from 'pinia';
import { use_home_page_store } from '../Store/home_page_store.js';

export default {

    methods: {
        check_image_url: function (url) {
            try {
                new URL(url);
                return url;
            } catch (e) {
                return "/" + url;
            }
        },
    },

    computed: {
        ...mapState(use_home_page_store, {
            brands: "all_brands",
        }),
    },
}
</script>

<style>
.no-image {
    background-image: url("/dummy.png");
    height: 90px;
    width: 90px;
    background-position: center center;
    background-repeat: no-repeat;
    background-size: contain;
    border: 1px solid rgba(128, 128, 128, 0.274);
    border-radius: 50%;
    padding: 10px;
    text-align: center;
}
</style>
