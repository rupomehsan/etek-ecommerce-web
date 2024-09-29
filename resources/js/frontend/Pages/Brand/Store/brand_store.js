import axios from "axios";
import { defineStore } from "pinia";

export const brand_store = defineStore("brand_store", {
    state: () => ({
        slug: '',
        products: {},
        brand: {},
        bread_cumb: [
            {
                title: 'brand',
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
        get_products_by_brand_id: async function (url = null) {

            if (url) {
                let response = await axios.get(url);
                this.brand = response.data?.data?.brand;
                this.products = response.data?.data?.data;
            } else {
                let set_query_params = new URL(location.origin + `/api/v1/get-all-products-by-brand-id/${this.slug}`);
                set_query_params.searchParams.set('page', 1);
                let response = await axios.get(set_query_params.href);
                this.brand = response.data?.data?.brand;
                this.products = response.data?.data?.data;
            }
            
        },

        /**
        ## Product information
        ## end
        **/


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





    }
});
