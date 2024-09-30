import axios from "axios";
import { defineStore } from "pinia";

export const product_store = defineStore("product_store", {
    state: () => ({
        slug: '',
        products: [],
        product_category_varients: [],
        product_category_wise_brands: [],

        category: {},
        childrens: [],
        advertise: null,
        bread_cumb: [
            {
                title: 'category',
                url: '#',
                active: false,
            },
        ],

        variant_values_id: [],
        brand_id: [],

        min_price: 0,
        max_price: 0,

        price_range: {
            min_price: 0,
            max_price: 50000,
        },
        fields: [
            "id",
            "title",
            "short_description",
            "customer_sales_price",
            "discount_type",
"retailer_sales_price",
            "discount_amount",
            "product_brand_id",
            "sku",
            "type",
            "slug",
            "is_available"
        ],
        limit: 20
    }),
    getters: {},
    actions: {
        /**
        ## Product information
        ## start
        **/
        get_all_top_offer_products_by_offer_id: async function (url) {
            if (url) {
                let response = await axios.get(url);
                this.products = response.data.data;
            } else {
                let response = await axios.get(`/get-all-top-products-offer-by-offer-id/${this.slug}`)
                if (response.data.status === "success") {
                    this.products = response.data.data
                }
            }

            // console.log(this.search_data)
        },
        get_all_products_and_single_group_by_category_group_id: async function (url) {
            const fieldsQuery = this.fields.map((field, index) => `fields[${index}]=${field}`).join('&');
            if (url) {
                let response = await axios.get(url);
                this.products = response.data.data;
            } else {
                let response = await axios.get(`/get-all-products-and-single-group-by-category-group-id/${this.slug}?limit=${this.limit}&${fieldsQuery}`);
                if (response.data.status === "success") {
                    this.products = response.data.data
                }
            }

            // console.log(this.search_data)
        },
        get_product_category_varients: async function (slug) {
            let response = await axios.get(`/get-product-category-varients/${slug}`, {
                params: {
                    brand_id: this.brand_id
                }
            })
            if (response.data.status === "success") {
                this.product_category_varients = response.data.data
            }
        },
        get_product_category_wise_brands: async function (slug) {
            let response = await axios.get(`/get-product-category-brands/${slug}`)
            if (response.data.status === "success") {
                this.product_category_wise_brands = response.data.data
            }
        },
        get_min_max_price: async function (slug) {
            let response = await axios.get(`/get-min-max-price-by-category-id/${slug}`)
            if (response.data.status === "success") {
                this.min_price = response.data.data?.min_price
                this.max_price = response.data.data?.max_price
            }
        },
        set_limit: (limit) => {
            this.limit = limit
            this.get_products_by_category_id()
        },
        /**
        ## Product information
        ## end
        **/

        get_products_by_category_id: async function (url = null) {
            const fieldsQuery = this.fields.map((field, index) => `fields[${index}]=${field}`).join('&');
            if (url) {
                let response = await axios.get(url);
                this.products = response.data.data;
            } else {
                let set_query_params = new URL(location.origin + `/api/v1/get-all-products-by-category-id-with-verient-and-brand/${this.slug}?limit=${this.limit}&${fieldsQuery}`);
                set_query_params.searchParams.set('page', 1);

                if (this.variant_values_id.length > 0) {
                    set_query_params.searchParams.set('variant_values_id', this.variant_values_id.join(','));
                }
                if (this.brand_id.length > 0) {
                    set_query_params.searchParams.set('brand_id', this.brand_id.join(','));
                }

                if (this.price_range.min_price && this.price_range.max_price) {
                    set_query_params.searchParams.set('min', `${this.price_range.min_price}`);
                    set_query_params.searchParams.set('max', `${this.price_range.max_price}`);
                }

                let res = await axios.get(set_query_params.href);
                let data = res.data;

                this.category = data.category;
                this.products = data.products;
                this.advertise = res.data.advertise;
                this.childrens = res.data.childrens;

                if (data.min_price < this.price_range.min_price) {
                    this.price_range.min_price = data.min_price
                }

                if (data.max_price > this.price_range.max_price) {
                    this.price_range.max_price = data.max_price
                }
                this.min_price = res.data.min_price
                this.max_price = res.data.max_price

            }

        },

        set_bread_cumb: function () {
            function getParentsArray(obj, seenObjects = new Set()) {
                let parentsArray = [];
                function helper(currentObj) {
                    if (seenObjects.has(currentObj)) {
                        throw new Error("Infinite parents detected");
                    }
                    seenObjects.add(currentObj);
                    parentsArray.push(currentObj);
                    if (currentObj && typeof currentObj === 'object' && currentObj.parents) {
                        helper(currentObj.parents);
                    }
                }
                helper(obj);
                return parentsArray;
            }

            function reverseArray(arr) {
                let reversedArray = [];
                for (let i = arr.length - 1; i >= 0; i--) {
                    reversedArray.push(arr[i]);
                }
                return reversedArray;
            }

            let parents = getParentsArray(this.category);
            parents = reverseArray(parents);

            this.bread_cumb = [];
            parents.forEach((parent) => {
                this.bread_cumb.push({
                    title: parent.title,
                    url: '/products/' + parent.slug,
                    active: false,
                })
            });
        },

        load_product: async function (link) {
            try {
                let link_url = new URL(location.origin + link.url);

                let url = new URL(location.origin + `/api/v1/get-all-products-by-category-id-with-verient-and-brand/${this.slug}`);
                url.searchParams.set('page', link_url.searchParams.get('page'));

                let res = await axios.get(url.href);
                this.products = res.data.products;
                window.scrollTo({
                    top: 300,
                    behavior: 'smooth'
                });
            } catch (error) {
                console.error('Error loading product:', error);
            }
        },


        set_varient_value_id: function (id) {
            this.min_price = 0
            this.max_price = 0
            if (this.variant_values_id.includes(id)) {
                this.variant_values_id.splice(this.variant_values_id.indexOf(id), 1);
            } else {
                this.variant_values_id.push(id);
            }
        },

        set_brand_id: function (id) {

            this.min_price = 0
            this.max_price = 0
            if (this.brand_id.includes(id)) {
                this.brand_id.splice(this.brand_id.indexOf(id), 1);
            } else {
                this.brand_id.push(id);
            }

            this.get_product_category_varients(this.slug)
        },
        set_min_max_price_range: function (min, max) {
            this.price_range = {
                min_price: min,
                max_price: max
            }
            this.get_products_by_category_id()
            console.log(min, max);
        }

    }
});
