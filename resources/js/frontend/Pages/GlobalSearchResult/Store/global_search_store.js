import { defineStore } from "pinia";


export const use_global_search_store = defineStore("use_global_search_store", {
    state: () => ({
        search_result_data: {
            category: {},
            brand: {},
            product: {},
        },
        search_key: '',
    }),

    actions: {
        reset_search: function(){
            this.search_key = "",
            this.search_result_data = {
                category: {},
                brand: {},
                product: {},
            };
        },
        set_search_key: function(v){
            this.search_key = v;
        },
        global_search: async function (url) {
            if (url) {
                let response = await axios.get(url);
                this.search_result_data = response.data.data;
            } else {
                let response = await axios.get(`/home-page-global-search?search_key=${this.search_key}`)
                if (response.data.status === "success") {
                    this.search_result_data = response.data.data
                }
            }
        },
    },
});
