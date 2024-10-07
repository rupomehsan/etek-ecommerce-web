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
    }),
    getters: {},
    actions: {
        /**
        ## Product information
        ## start
        **/
        get_products_by_category_id: async function (url = null) {

            if (url) {
                let response = await axios.get(url);
                this.category = response.data?.data?.category;
                this.products = response.data?.data?.data;
            } else {
                let set_query_params = new URL(location.origin + `/api/v1/get-all-products-by-category-id/${this.slug}`);
                set_query_params.searchParams.set('page', 1);
                let response = await axios.get(set_query_params.href);
                this.category = response.data?.data?.category;
                this.products = response.data?.data?.data;
            }

        },
        /**
        ## Product information
        ## end
        **/








    }
});
