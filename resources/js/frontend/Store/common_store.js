import { defineStore, mapState } from "pinia";
import { auth_store } from "./auth_store";

export const common_store = defineStore("common_store", {
    state: () => ({
        all_cart_data: [],
        all_wish_list_data: [],
        all_compare_list_data: [],
        navbar_menu_data: [],
        website_settings_data: [],
        total_cart_price: 0,
        preloader: false,
        fields: ['title', 'external_link'],
        productFields: [
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
        ]
    }),

    actions: {
        //cart
        //cart
        get_all_cart_data: async function () {
            let token = localStorage.getItem('token');
            if (token) {
                // this.total_cart_price = 0;
                let that = this
                const fieldsQuery = this.productFields.map((field, index) => `fields[${index}]=${field}`).join('&');
                let response = await window.privateAxios(`/get-cart-items?get_all=1&${fieldsQuery}`);
                if (response.status == "success") {
                    this.all_cart_data = response?.data;
                    if (this.all_cart_data.length) {
                        let itemTotal = this.all_cart_data.map(function (item) {
                            return item.quantity * that.get_price(item.product).new_price
                        });
                        itemTotal.forEach((item2) => {
                            this.total_cart_price = this.total_cart_price + item2;
                        });
                    }
                }
            }
        },

        add_to_cart: async function (productId, product) {
            // console.log(productId);

            let temp = JSON.parse(JSON.stringify(product));
            temp.quantity = 1;
            temp.type = 'product';
            temp.product = product;
            this.all_cart_data.unshift(temp);

            const response = await window.privateAxios(`/add-to-cart`, 'post',
                {
                    product_id: productId,
                }
            );

            if (response?.status === "success") {
                window.s_alert(response.message);
                // this.get_all_cart_data();
            }

        },

        cart_quantity_update: async function (cartId, action, quantity) {

            const response = await axios.post(
                `/update-cart-item-quantity`,
                {
                    cartId,
                    action,
                    quantity,
                }
            );

            if (response.data.status === "success") {
                // window.s_alert(response.data.message);
                this.get_all_cart_data();
            }
            if (response.data.status === "warning") {
                // window.w_alert(response.data.message);
            }
        },

        remove_cart_item: async function (cartId) {
            var data = await window.s_confirm();
            if (data) {
                let response = await axios.delete(
                    `/remove-cart-item/${cartId}`
                );
                if (response.data.status == "success") {
                    // window.s_alert(response.data.message);
                    this.get_all_cart_data();
                }
            }
        },

        //wishlist
        //wishlist
        get_all_wish_list_items: async function () {
            this.total_cart_price = 0;
            let response = await window.privateAxios(`/get-wish-list-items?get_all=1`);
            if (response.status == "success") {
                this.all_wish_list_data = response.data;
            }
        },
        add_to_wish_list: async function (productId) {
            const response = await window.privateAxios(`/add-to-wish-list`, 'post',
                {
                    product_id: productId,
                }
            );

            if (response.status === "success") {
                window.s_alert(response.message);
            }

            if (response.status === "warning") {
                window.w_alert(response.message);
            }
        },
        remove_wish_list_item: async function (id) {
            var data = await window.s_confirm();
            if (data) {
                let response = await window.privateAxios(`/remove-wish-list-item/${id}`, 'delete');
                if (response.status == "success") {
                    window.s_alert(response.message);
                    this.get_all_wish_list_items();
                }
            }
        },

        //comparelist
        //comparelist
        get_all_compare_list_items: async function () {
            let response = await window.privateAxios(`/get-compare-list-items?get_all=1`);
            if (response.status == "success") {
                this.all_compare_list_data = response.data;
            }
        },
        add_to_compare_list: async function (productId) {
            const response = await window.privateAxios(`/add-to-compare-list`, 'post',
                {
                    product_id: productId,
                }
            );

            if (response.status === "success") {
                window.s_alert(response.data.message);
            }

            if (response.status === "warning") {
                window.w_alert(response.data.message);
            }
        },
        remove_compare_list_item: async function (id) {
            var data = await window.s_confirm();
            if (data) {
                let response = await window.privateAxios(`/remove-compare-list-item/${id}`, 'delete');
                if (response.status == "success") {
                    window.s_alert(response.message);
                    this.get_all_compare_list_items();
                }
            }
        },

        //website settigns
        //website settigns
        get_all_website_settings: async function () {
            if(this.website_settings_data.length !== 0){
               return false;
            }
            this.preloader = true;
            try {
                let response = await axios.get(`/get-website-settings`);
                if (response.data.status == "success") {
                    this.website_settings_data = response.data.data;
                }
            } finally {
                this.preloader = false;
            }

        },

        get_setting_value: function (key, multiple = false) {
            // this.preloader = true;
            let is_empty = false;
            if(this.website_settings_data.length == 0){
                is_empty = true;
            }
            try {
                if (!multiple) {
                    if(is_empty) return '';

                    let data = ''
                    let value = this.website_settings_data.find(item => item.title === key);
                    if (value && value.setting_values.length > 0) {
                        data = value.setting_values[0].value
                        // this.preloader = false;
                    }
                    return data
                } else {
                    if(is_empty) return [];

                    let values = this.website_settings_data.filter(item => item.title === key);
                    if (values && values.length > 0) {
                        return values[0].setting_values;
                        // this.preloader = false;
                    }
                    return [];
                }
            } catch (error) {
                console.error(error);
            }
        },

        //navbar_menu
        //navbar_menu
        get_all_website_navbar_menu: async function (all_parent = false) {
            // let fieldsQueryString = this.fields.map((field, index) => `fields[${index}]=${field}`).join('&');
            // let url = `/navbar-menus?get_all=1&${fieldsQueryString}`;
            // if (all_parent) {
            //     url = `/navbar-menus?get_all=1&all_parent=1&${fieldsQueryString}`;
            // }
            // let response = await axios.get(url);
            // if (response.data.status == "success") {
            //     this.navbar_menu_data = response.data.data;
            // }
        },


        get_price(product) {

            let old_price = 0;
            let new_price = 0;

            if(!product){
                return {
                    old_price: old_price,
                    new_price: new_price
                }
            }

            let authStore = mapState(auth_store, {
                auth_info: "auth_info",
                is_auth: "is_auth",
            });

            if (product.type == "medicine") {

                if (product.medicine_product_verient?.pv_b2c_discount_percent) {
                    new_price = Math.round(product.medicine_product_verient?.pv_b2c_price)
                    old_price = Math.round(product.medicine_product_verient?.pv_b2c_mrp)
                } else {
                    old_price = Math.round(product.medicine_product_verient?.pv_b2c_mrp)
                }

            } else if (product.type == "product") {

                if (product.is_discount) {
                    new_price = Math.round(product.current_price)
                    old_price = Math.round(product.customer_sales_price)
                } else {
                    new_price = Math.round(product.current_price)
                }
            }

            if (authStore.is_auth()) {
                let userType = authStore.auth_info().role?.name;
                if (userType == 'customer') {
                    if (product.type == "medicine") {

                        if (product.medicine_product_verient?.pv_b2c_discount_percent) {
                            new_price = Math.round(product.medicine_product_verient?.pv_b2c_price)
                            old_price = Math.round(product.medicine_product_verient?.pv_b2c_mrp)
                        } else {
                            old_price = Math.round(product.medicine_product_verient?.pv_b2c_mrp)
                        }

                    } else if (product.type == "product") {
                        if (product.is_discount) {
                            new_price = Math.round(product.current_price)
                            old_price = Math.round(product.customer_sales_price)
                        } else {
                            old_price = Math.round(product.customer_sales_price)
                        }
                    }
                } else if (userType == 'retailer') {

                    if (product.type == "medicine") {

                        if (product.medicine_product_verient?.pv_b2b_discount_percent) {
                            new_price = Math.round(product.medicine_product_verient?.pv_b2b_price)
                            old_price = Math.round(product.medicine_product_verient?.pv_b2b_mrp)
                        } else {
                            old_price = Math.round(product.medicine_product_verient?.pv_b2b_mrp)
                        }

                    } else if (product.type == "product") {

                        if (product.is_discount) {
                            new_price = Math.round(product.current_price)
                            old_price = Math.round(product.customer_sales_price)
                        } else {
                            old_price = Math.round(product.customer_sales_price)
                        }

                    }

                }
            }

            return {
                old_price: old_price,
                new_price: new_price
            }
        }

    },
});
