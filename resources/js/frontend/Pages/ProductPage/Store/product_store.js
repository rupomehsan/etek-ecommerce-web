import axios from "axios";
import { defineStore } from "pinia";

export const product_store = defineStore("product_store", {
    state: () => ({
        search_key: '',
        query_param: '',
        slug: '',
        products: [],
        brand: {},
        brands: [],
        category: {},
        categories: [],
        product_category_varients: [],
        product_category_wise_brands: [],

        childrens: [],
        advertise: null,


        variant_values_id: [],
        brand_id: [],

        min_price: 0,
        max_price: 0,

        limit: 20,
        preloader: false,

        price_range: {
            min_price: 0,
            max_price: 50000,
        },

        sort_type: '',
        sort_by_col: '',

        fields: [
            "id",
            "title",
            "short_description",
            "customer_sales_price",
            "retailer_sales_price",
            "discount_type",
            "discount_amount",
            "product_brand_id",
            "sku",
            "type",
            "slug",
            "is_available"
        ],
        bread_cumb: [
            {
                title: 'Products',
                url: '#',
                active: false,
            },
        ],

    }),
    getters: {},
    actions: {

        reset_search: function () {
            this.search_key = "",
                this.category = {},
                this.brand = {},
                this.products = []
        },
        /**
        ## Product information
        ## start
        **/

        global_search: async function (url = null) {
            try {
                this.preloader = true;
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });

                const fieldsQuery = this.fields.map((field, index) => `fields[${index}]=${field}`).join('&');

                let response;

                if (url) {
                    response = await axios.get(url + `&${fieldsQuery}&limit=${this.limit}`);
                } else {
                    response = await axios.get(`/home-page-global-search?search_key=${this.search_key}&${fieldsQuery}&limit=${this.limit}`);
                }

                if (response.data.status === "success") {
                    this.products = response.data.data.product;
                    this.categories = response.data.data.category;
                    this.brands = response.data.data.brand;

                }

                this.preloader = false;

            } catch (error) {
                console.error('Error during search:', error);
                this.preloader = false;
            }

        },


        get_products_by_category_id: async function (url = null) {
            this.preloader = true;
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });

            // Build the fields query string
            const fieldsQuery = this.fields.map((field, index) => `fields[${index}]=${field}`).join('&');

            let response;
            if (url) {
                // If a URL is provided, make a request to that URL
                response = await axios.get(url + `&${fieldsQuery}`);
            } else {
                // Create the base URL
                const baseUrl = `${location.origin}/api/v1/get-all-products-by-category-id/${this.slug}`;

                // Create URLSearchParams to manage query parameters
                const params = new URLSearchParams({
                    limit: this.limit,
                    page: 1,
                    ...this.fields.reduce((acc, field, index) => {
                        acc[`fields[${index}]`] = field;
                        return acc;
                    }, {})
                });

                // Combine base URL with query parameters
                const set_query_params = new URL(`${baseUrl}?${params.toString()}`);

                // Make the request
                response = await axios.get(set_query_params.href);
            }

            this.category = response.data?.data?.category;
            this.products = response.data?.data?.data;

            this.preloader = false;
        },


        get_all_top_offer_products_by_offer_id: async function (url = null) {
            this.preloader = true;
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });

            const fieldsQuery = this.fields.map((field, index) => `fields[${index}]=${field}`).join('&');

            let response;

            if (url) {
                response = await axios.get(url + `&${fieldsQuery}&limit=${this.limit}`);
            } else {
                response = await axios.get(`/get-all-top-products-offer-by-offer-id/${this.slug}&${fieldsQuery}&limit=${this.limit}`);
            }

            if (response.data.status === "success") {
                this.products = response.data?.data?.data
                this.category = response.data?.data?.productOfferDetails;

            }


            this.preloader = false;
        },
        get_all_products_and_single_group_by_category_group_id: async function (url = null) {

            this.preloader = true;
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });

            const fieldsQuery = this.fields.map((field, index) => `fields[${index}]=${field}`).join('&');
            if (url) {
                let response = await axios.get(url + `?limit=${this.limit}&${fieldsQuery}`);
                this.products = response.data.data?.data
                this.category = response.data?.data?.categoryGroup;
            } else {
                let response = await axios.get(`/get-all-products-and-single-group-by-category-group-id/${this.slug}?limit=${this.limit}&${fieldsQuery}`);
                if (response.data.status === "success") {
                    this.products = response.data.data?.data
                    this.category = response.data?.data?.categoryGroup;
                }
            }

            this.preloader = false;

        },


        load_product: async function (link) {
            if (this.query_param == 'search') {
                this.global_search(link)
            }
            if (this.query_param == 'category') {
                this.get_products_by_category_id(link)
            }
            if (this.query_param == 'top-offer') {
                this.get_all_top_offer_products_by_offer_id(link)
            }
            if (this.query_param == 'category-group') {
                this.get_all_products_and_single_group_by_category_group_id(link)
            }
        },


        /**
        ## Product information
        ## end
        **/


        /**
        ## Setter
        **/
        set_limit: function (limit) {
            this.limit = limit
            if (this.query_param == 'search') {
                this.global_search()
            }
            if (this.query_param == 'category') {
                this.get_products_by_category_id()
            }
            if (this.query_param == 'top-offer') {
                this.get_all_top_offer_products_by_offer_id()
            }
            if (this.query_param == 'category-group') {
                this.get_all_products_and_single_group_by_category_group_id()
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

        set_search_key: function (search_key, query_param) {
            this.search_key = search_key

        },
        set_sort: function (type, value) {
            this.sort_type = type
            this.sort_by_col = value
        },
        set_slug: function (slug) {
            this.slug = slug
        },
        set_query_param: function (query_param) {
            this.query_param = query_param
        },
        updateSearchKey: function (SearchKey) {
            this.search_key = SearchKey
        }
        /**
        ## Setter
        ## end
        **/
    }
});
