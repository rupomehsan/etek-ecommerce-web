<template lang="">
    <div>
        <div class="category_modal_toggler" @click="toggle_category">
            <img src="/frontend/images/categories24.svg" alt="">
            <span class="text">
                categories
            </span>
        </div>

        <div class="modal_category_left_side_show modal_category_all_page modal_category">
            <div class="category_modal_back_button" @click="close_category">
                <i class="fa fa-angle-left"></i>
            </div>
            <div class="modal_category_all_page_content">
                <div class="parent_categories">
                    <ul>
                        <li
                            v-for="category in parent_categories"
                            :key="category.id">
                            <div class="cat_item"
                                @click="set_selected(category)"
                                :class="{active: selected.id == category.id}">
                                <img :src="load_image(`${category.image}`, 1, 1, 100, 100)">
                                <span class="link_title">
                                    {{ category.title }}
                                </span>
                            </div>
                        </li>
                    </ul>
                </div>

                <div class="right_category_list">
                    <div class="category_modal_close" @click="close_category">
                        <i class="fa fa-close"></i>
                    </div>

                    <template v-for="(category_groups, index) in sub_categories" v-if="Object.keys(sub_categories).length" :key="index">
                        <h5 class="categor_modal_right_header">{{index}}</h5>

                        <ul class="category_list">
                            <li v-for="category in category_groups"
                                :key="category.id">
                                <div @click="visit_category(category.slug)">
                                    <img :src="load_image(`${category.image}`,1, 1, 100, 100)">
                                    <span class="link_title">
                                        {{ category.title }}
                                    </span>
                                </div>
                            </li>
                        </ul>
                    </template>
                </div>
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
        sub_categories: {},
    }),
    watch: {
        selected: {
            handler:function () {
                this.get_sub_categories();
            },
            deep: true,
        },
        parent_categories: function(v){
            try {
                if(!this.set_selected?.slug){
                    this.set_selected(v[0]);
                }
            } catch (error) {
            }
        }
    },
    created: function () {
    },
    mounted: function(){
        if(!this.set_selected?.slug){
            try{
                this.set_selected(this.parent_categories[0]);
            } catch (error){

            }
        }
    },
    methods: {
        load_image: window.load_image,
        set_selected: function(item){
            this.selected = item;
            this.get_sub_categories();
        },
        close_category: function () {
            document.querySelector('.modal_category_all_page').classList.toggle('active');
        },
        toggle_category: function () {
            document.querySelector('.modal_category_all_page').classList.toggle('active');
        },
        visit_category: function (slug) {
            this.close_category();
            router.visit(`/products/${slug}`);
        },
        get_sub_categories: function () {
            if(this.selected?.slug){
                axios.get(`get-all-sub-category-by-category-id/${this.selected.slug}?get_all=1`)
                    .then(res => {
                        this.sub_categories = res.data?.data;
                    });
            }
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
