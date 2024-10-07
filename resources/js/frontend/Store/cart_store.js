
import { defineStore } from "pinia";
import { auth_store } from "./auth_store";
import { privateAxios } from "../plugins/axios_setup";
import { router } from '@inertiajs/vue3'

export const cart_store = defineStore("cart_store", {
    state: () => ({
        carts: [],
    }),
    getters: {
        total_price: function () {
            // console.log(this.carts);
            let total = this.carts.reduce((t, i) => t += (+i.qty * +(i.final_price)), 0);
            // console.log(total);
            return total;
        }
    },
    actions: {
        add_to_cart: function (product, qty = null) {
            let check = this.carts.find(i => i.product_id == product.product_id);

            if (check && qty) {
                check.qty = qty;
            } else if (check && check.qty) {
                check.qty++;
            }

            if (!check) {
                product.qty = 1;
                product.product_id = product.id;
                product.final_price = product.final_price;
                this.carts.push(product);
                this.update_db(product.product_id, product.qty);
            }else{
                this.update_db(product.product_id, check.qty);
            }

            this.update_local_store();
        },

        buy_now: function(product){
            this.add_to_cart(product);
            router.visit('/checkout');
        },

        update_db: async function (product_id, qty) {
            let auth = auth_store();
            if (!auth.is_auth) return;

            const response = await privateAxios(
                `/add-to-cart`,
                'post',
                {
                    product_id: product_id,
                    quantity: qty,
                }
            );
        },

        is_in_cart: function (product) {
            let value = {
                qty: 0,
                status: false
            }

            let check = this.carts.find(i => i.product_id == product.id);

            if (check) {
                value.qty = check.qty;
                value.status = true;
            }

            return value;
        },

        delete_item: function (product) {
            this.carts = this.carts.filter(i => i.product_id != product.product_id);
            this.update_local_store();

            let auth = auth_store();
            if (!auth.is_auth) return;
            window.privateAxios(`/remove-cart-item/${product.product_id}`, 'delete');
        },

        empty_cart: function(){
            this.carts = [];
            this.update_local_store();
        },

        update_local_store: function(){
            localStorage.setItem('carts', JSON.stringify(this.carts));
        },

        send_order_email: function(order_id, email){
            window.axios.post('/send-order-email', {
                order_id: order_id,
                email: email,
            });
        }
    },
});
