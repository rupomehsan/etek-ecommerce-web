<template lang="">
    <div>
        <div class="category_modal_toggler" @click="toggle_category">
            <img src="/frontend/images/categories24.svg" alt="">
            <span class="text">
                categories
            </span>
        </div>

        <div class="modal_category_left_side_show modal_category_all_page modal_category">
            <div class="modal_category_all_page_content">
                <div class="parent_categories">
                    <ul>
                        <li
                            v-for="category in parent_categories"
                            :key="category.id">
                            <div class="cat_item"
                                @click="selected = category"
                                :class="{active: selected.id == category.id}">
                                <img :src="load_image(`${category.image}`)" :alt="category.title">
                                <span class="link_title">
                                    {{ category.title }}
                                </span>
                            </div>
                        </li>
                    </ul>
                </div>
                <ul class="category_list" :class="{d_grid: nav_categories.length > 10}" >
                    <li class="category_modal_close" @click="close_category">
                        <i class="fa fa-close"></i>
                    </li>
                    <li v-if="sub_categories.length" v-for="category in sub_categories" :key="category.id">
                        <div @click="visit_category(category.slug)">
                            <img :src="load_image(`${category.image}`)" :alt="category.title">
                            <span class="link_title">
                                {{ category.title }}
                            </span>
                        </div>
                    </li>
                    <li v-else v-for="category in nav_categories" :key="category.id">
                        <div @click="visit_category(category.slug)">
                            <img :src="load_image(`${category.image}`)" :alt="category.title">
                            <span class="link_title">
                                {{ category.title }}
                            </span>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>
<script>
import { router } from '@inertiajs/vue3'
import { use_home_page_store } from "../../Store/home_page_store";
import { mapState } from 'pinia';
import axios from 'axios';

export default {
    data: () => ({
        selected: {},
        sub_categories: [],
    }),
    watch: {
        selected: function () {
            this.get_sub_categories();
        }
    },
    created: function(){
        console.log('all ctegories');
    },
    methods: {
        load_image: window.load_image,
        close_category: function () {
            document.querySelector('.modal_category_all_page').classList.toggle('active');
        },
        toggle_category: function () {
            document.querySelector('.modal_category_all_page').classList.toggle('active');
        },
        visit_category: function (slug) {
            this.close_category();
            router.visit(`/category/${slug}`);
        },
        get_sub_categories: function () {
            axios.get(`get-all-sub-category-by-category-id/${this.selected.slug}?get_all=1`)
                .then(res => {
                    this.sub_categories = res.data?.data;
                });
        }
    },
    computed: {
        ...mapState(use_home_page_store, {
            parent_categories: "parent_categories",
            nav_categories: "side_nav_categories",
        }),
    },
}
</script>
<style lang="">

</style>
