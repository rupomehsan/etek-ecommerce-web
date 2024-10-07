import axios from "axios";
import { defineStore } from "pinia";

export const search_store = defineStore("search_store", {
    state: () => ({
        key: '',
        products: [],
        is_loading: false,
        search_text: '',
    }),
    getters: {},
    actions: {
        search_products: async function () {
            this.is_loading = true;
            this.search_text = "";
            await axios.get('/search-products?key=' + this.key)
                .then(res => {
                    this.products = res.data.data;
                    this.is_loading = false;
                    if(res.data.data?.length == 0){
                        this.search_text ='no data found.'
                    }
                })
        }
    }
});
