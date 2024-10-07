<template>
    <Layout>
        <section class="mobile_search_results">
            <div class="custom-container">
                <div v-if="is_loading" class="my-5 text-center">
                    <img src="/loader.gif" style="height: 40px;" />
                </div>
                <div v-if="search_text" class="text-center mb-3">
                    {{ search_text }}
                </div>
                <div class="product_list">

                    <product-item :product="i" v-for="i in products" :key="i.id" />

                </div>
            </div>
        </section>
    </Layout>
</template>

<script>
import Layout from "../../Shared/Layout.vue";
import { search_store } from "./store/search_store";
import { mapWritableState, mapActions } from "pinia";
import debounce from "debounce";
import ProductItem from "../../Components/ProductItem.vue";

export default {
    components: { Layout, ProductItem },
    methods: {
        ...mapActions(search_store, [
            "search_products",
        ]),
    },
    mounted: function () {
        let el = document.querySelector('input[name="header_search_input"]');
        if (el) {
            el.focus();
        }
    },
    beforeUnmount: function () {
        this.key = "";
        this.products = [];
    },
    watch: {
        key: debounce(async function (v) {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
            this.products = [];
            if (this.key.length) {
                await this.search_products();
            }
        }, 1000)
    },
    computed: {
        ...mapWritableState(search_store, [
            "key",
            "products",
            "is_loading",
            "search_text",
        ])
    },
};
</script>
