import axios from "axios";
import { defineStore } from "pinia";

export const shop_store = defineStore("shop_store", {
    state: () => ({
        slug: "",
        category_group: {},
        categories: [],
        banners: [],
        featured_categories: [],
        featured_category_products: [],
    }),

    actions: {
    },
});
