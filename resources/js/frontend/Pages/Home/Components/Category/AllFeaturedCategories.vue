<template lang="">
    <div class="custom-container">
        <div class="section_title">
            <h4 class="text mb-lg-5 mb-3">Featured Categories</h4>
        </div>
        <div class="home_featured_categories">
            <div class="item" v-for="(category, index) in home_featured_categories" :key="category.id">
                <Link :href="`/products/${category.slug}`">
                    <img :src="category.image" />
                    {{category.title}}
                </Link>
            </div>
        </div>
    </div>
</template>
<script>
import { computed } from 'vue';
import { use_home_page_store } from '../../Store/home_page_store';
import { mapState } from 'pinia';

export default {
    computed:{
        ...mapState(use_home_page_store,[
            "home_featured_categories"
        ])
    },
}
</script>
<style lang="">

</style>
