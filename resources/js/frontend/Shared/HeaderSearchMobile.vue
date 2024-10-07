<template lang="">
    <div class="mobile_header">
        <div class="custom-container">
            <div class="header_search_wrapper">
                <i class="fa fa-search header_search_icon"></i>
                <input type="search" @keyup="(e)=>key=e.target.value" @click="visit_search()" placeholder="search product"
                name="header_search_input"/>
            </div>
        </div>
    </div>
</template>
<script>
import { router } from '@inertiajs/vue3';
import { search_store } from "../Pages/MobileSearch/store/search_store";
import { mapWritableState } from "pinia";
export default {
    methods: {
        visit_search: function () {
            if (window.location.pathname != '/search-products') {
                router.visit('/search-products');
            }
        }
    },

    computed: {
        ...mapWritableState(search_store, [
            "key",
        ]),
    }
}
</script>
<style lang="">

</style>
