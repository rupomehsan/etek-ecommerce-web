import axios from "axios";
import { defineStore } from "pinia";


export const use_home_page_store = defineStore("use_home_page_store", {
    state: () => ({
        home_hero_sliders: [],
        home_hero_slider_side_banner: [],
        side_nav_categories: [],
        parent_categories: [],
        sub_categories: [],
        all_top_products_offer: [],
        all_category_groups: [],
        all_heighlight_products: {
            "best_selling_products" : [],
            "new_products" : [],
            "trending_products" : [],
        },
        home_featured_categories:[],
        feature_products: [],
        all_brands: [],
        preloader: {
            banner: true,
            side_nav_category: true,
            top_products: true,
            category_group: true,
        },
        fields: [
            "id",
            "title",
            "customer_sales_price",
            "discount_type",
            "discount_amount",
            "product_brand_id",
            "sku",
            "type",
            "slug",
            "is_available",

        ],
        BrandFields: [
            "id",
            "title",
            "image",
            "slug",
        ]
    }),

    actions: {
        get_all_home_hero_sliders: async function () {
            this.preloader.banner = true
            try {
                let response = await axios.get('/get-home-page-hero-sliders?get_all=1&is_show=1');
                if (response.data.status === "success") {
                    this.home_hero_sliders = response.data.data;
                }
            } finally {
                this.preloader.banner = false;
            }
        },

        get_all_home_slider_side_banners: async function () {

            try {
                let response = await axios.get('/get-home-page-hero-slider-side-banners');
                if (response.data.status === "success") {
                    this.home_hero_slider_side_banner = response.data.data;
                }
            } finally {

            }
        },
        get_side_nav_categories: async function () {
            this.preloader.side_nav_category = true;

            try {

                if (this.side_nav_categories.length > 0) {
                    this.preloader.side_nav_category = false;
                    return
                }

                let url = `/get-all-nav-categories?get_all=1`;
                let res = await axios.get(url);
                this.side_nav_categories = res.data?.data;

            } finally {
                this.preloader.side_nav_category = false;
            }




        },
        get_parent_categories: async function (all_parent = true) {
            if (this.parent_categories.length > 0) {
                return
            }
            let url = `/get-all-parent-categories?get_all=1&`;
            if (all_parent) {
                url = `/get-all-parent-categories?get_all=1&all_parent=1`;
            }
            let res = await axios.get(url);
            let data = res.data?.data;
            this.parent_categories = data;
        },
        get_sub_categories: async function (slug) {
            let res = await axios.get(`/category/${slug}/subcategories`);
            let data = res.data;
            this.sub_categories = data;
        },


        get_all_top_products_offer: async function () {
            this.preloader.top_products = true;
            try {
                if (this.all_top_products_offer.length > 0) {
                    return
                }
                let response = await axios.get('/get-all-top-product-offer?get_all=1')
                if (response.data.status === "success") {
                    this.all_top_products_offer = response.data.data
                }
            } finally {
                this.preloader.top_products = false;
            }
        },

        get_all_category_groups: async function () {
            this.preloader.category_group = true;
            let response = await axios.get('/get-all-category-groups?get_all=1')
            this.all_category_groups = response.data
            // try {
            //     if (this.all_category_groups.length > 0) {
            //         return
            //     }
            //     if (response.data.status === "success") {
            //     }
            // } finally {
            //     this.preloader.category_group = false;
            // }
        },

        get_all_featured_products: async function () {
            if (this.feature_products.length > 0) {
                return
            }
            const fieldsQuery = this.fields.map((field, index) => `fields[${index}]=${field}`).join('&');
            let res = await axios.get("/get-all-featured-products?get_all=1&limit=40&" + fieldsQuery);
            if (res.data?.status === "success") {
                this.feature_products = res.data?.data;
            }
        },

        get_all_brands: async function () {
            if (this.all_brands.length > 0) {
                return
            }
            const fieldsQuery = this.BrandFields.map((field, index) => `fields[${index}]=${field}`).join('&');
            let response = await axios.get('/get-all-brands?get_all=1' + fieldsQuery);
            if (response.data.status === "success") {
                this.all_brands = response.data?.data
            }
        },


        store_news_letter_subscriber: async function (data) {
            let formData = new FormData(data)
            let response = await axios.post('website-subscribers/store', formData)
            if (response.data.status == 'success') {
                window.s_alert(response.data.message);
            }

        }

    },
});
