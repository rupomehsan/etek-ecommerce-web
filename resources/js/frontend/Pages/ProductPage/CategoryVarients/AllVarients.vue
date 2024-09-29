<template>
    <SingleVarient v-for="varient in varients" :key="varient.id" :varient="varient"></SingleVarient>
</template>
<script>
import axios from 'axios';
import SingleVarient from './SingleVarient.vue';

import { mapState } from 'pinia';
import { product_store } from '../Store/product_store.js';
export default {
    components: { SingleVarient },
    methods: {
        toggle_list: function () {
            $(this.$refs.items).slideToggle();
        }
    },
    computed: {
        ...mapState(product_store, {
            varients: 'product_category_varients',

        })
    }
}
</script>
<style lang="">

</style>
