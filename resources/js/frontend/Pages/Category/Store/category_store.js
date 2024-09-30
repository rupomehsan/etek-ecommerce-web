import axios from "axios";
import { defineStore } from "pinia";

export const category_store = defineStore("category_store", {
    state: () => ({
        slug: '',
        products: {},
        category: {},
        bread_cumb: [
            {
                title: 'category',
                url: '#',
                active: false,
            },
        ],
        limit: 20,
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
        ]

    }),
    getters: {},
    actions: {
        /**
        ## Product information
        ## start
        **/
        get_products_by_category_id: async function (url = null) {
            const fieldsQuery = this.fields.map((field, index) => `fields[${index}]=${field}`).join('&');
            if (url) {
                let response = await axios.get(url);
                this.category = response.data?.data?.category;
                this.products = response.data?.data?.data;
            } else {
                let set_query_params = new URL(location.origin + `/api/v1/get-all-products-by-category-id/${this.slug}?limit=${this.limit}&${fieldsQuery}`);
                set_query_params.searchParams.set('page', 1);
                let response = await axios.get(set_query_params.href);
                this.category = response.data?.data?.category;
                this.products = response.data?.data?.data;
            }

        },
        set_limit: function (limit) {
            this.limit = limit
            this.get_products_by_category_id()
        },
        /**
        ## Product information
        ## end
        **/








    }
});
