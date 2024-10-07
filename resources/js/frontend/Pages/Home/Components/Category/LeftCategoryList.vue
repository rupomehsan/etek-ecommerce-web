<template>
    <div class="modal_category_left_side_show">
        <div class="left_category_title">
            All Categories
        </div>
        <ul class="category_list">
            <li class="category_modal_close" @click="close_category">
                <i class="fa fa-close"></i>
            </li>

            <li v-for="category in side_nav_categories" :key="category.id">
                <Link :href="`/products/${category.slug}`">
                    <img :src="load_image(`${category.image}`)" :alt="category.title">
                    <span class="link_title">
                        {{ category.title }}
                    </span>
                </Link>
            </li>
        </ul>
    </div>
</template>
<script>

import { use_home_page_store } from '../../Store/home_page_store.js';
import { mapState,mapActions } from 'pinia';

export default {
    methods: {
        ...mapActions(use_home_page_store, {
            get_parent_categories: "get_parent_categories",

        }),
        close_category: function () {
            document.querySelector('.modal_category_left_side_show').classList.toggle('modal_category');
            document.querySelector('.modal_category_left_side_show').classList.toggle('active');
        },
        load_image: window.load_image,
    },

    created: async function() {
        console.log('left categories');
    },

    computed: {
        ...mapState(use_home_page_store, {
            side_nav_categories: "side_nav_categories",
        }),
    },
}
</script>
