<template>

    <div class="mb-3 bg-white card filter_card"
        v-if="product_category_wise_brands && product_category_wise_brands.length">
        <div @click.prevent="toggle_list" class="card-header bg-white d-flex justify-content-between">
            <b>
                Brand
            </b>
            <b>
                <i class="fa filter_toggler fa-angle-down"></i>
            </b>
        </div>
        <div class="p-2 pt-0" ref="items">
            <div class="collection-collapse-block open">
                <div class="collection-collapse-block-content">
                    <div class="collection-brand-filter">
                        <div v-for="brand in product_category_wise_brands" :key="brand.id"
                            class="custom-control custom-checkbox form-check collection-filter-checkbox d-flex">
                            <input type="checkbox" class="custom-control-input form-check-input mt-0"
                                :id="`brand` + brand.id" @change="set_brand_id(brand.id)">
                            <label class="custom-control-label form-check-label" style="flex: 1;"
                                :for="`brand` + brand.id">
                                <span class="d-flex justify-content-between">
                                    <span>{{ brand.title }}</span>
                                    <span v-if="brand.total_products">
                                        ({{ brand.total_products }})
                                    </span>
                                </span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import axios from 'axios';

import { mapActions, mapState } from 'pinia';
import { product_store } from '../Store/product_store.js';

export default {
    methods: {

        ...mapActions(product_store, {
            set_brand_id: "set_brand_id",
        }),

        toggle_list: function () {
            $(this.$refs.items).slideToggle();
        }

    },

    computed: {
        ...mapState(product_store, {
            product_category_wise_brands: 'product_category_wise_brands',
        })
    }
}
</script>
<style lang="">

</style>
