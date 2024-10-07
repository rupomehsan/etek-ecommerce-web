<template lang="">
    <div>
        <h2 class="section_heading">Shop By Category</h2>
    </div>
    <div class="home_featured_categories">
        <div class="item" v-for="item in categories" :key="item.id">
            <a :href="`/products/${item.slug}`">
                <img :src="load_image(item.image)">
                {{ item.title }}
            </a>
        </div>
    </div>
</template>
<script>
import { shop_store } from "../store/shop_store";
import { mapWritableState } from "pinia";
export default {
    data: () => ({
    }),
    created: function(){
    },
    computed: {
        ...mapWritableState(shop_store, [
            "categories",

        ])
    }
}
</script>
<style lang="">

</style>
