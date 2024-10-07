<template>
    <ProfileLayout :bread_cumb="bread_cumb">
        <div class="dashboard">
            <div class="page-title">
                <h2>
                    Order History
                </h2>
            </div>
            <hr>
            <div class="box-account box-info" v-if="order_list.data.length">

                <div class="card order_history_card my-3" v-for="order in order_list.data" :key="order.id">
                    <div class="card-header align-items-center">
                        <div class="">
                            <b>Order# {{ order.order_id }}</b>
                            <p>Date Added: {{ new Date(order.created_at).toDateString() }}</p>
                        </div>
                        <div>
                            <p> <b>Total :</b>
                                <span class="mx-2 fw-bold">{{ order.total }} TK</span>
                            </p>
                        </div>
                        <div class="right">
                            <div class="text-center">
                                <i class="fa fa-check"></i>
                                <span class="text-capitalize"
                                    :class="order.order_status == 'pending' ? 'text-info' : 'text-success'">{{
        order.order_status }}</span>
                            </div>

                            <Link :href="`/profile/order-details/${order.order_id}`" class="btn btn-primary text-light">
                            Order Details</Link>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="product_info_table table border-0 mb-0">
                                <tr v-for="(item, index) in order.order_products" :key="item.id">

                                    <td>
                                        <span>{{ index + 1 }}</span>
                                        <img :src="load_image(`${item.product?.product_image?.url}`)" alt="">
                                        <span>
                                            {{ item.product?.title }}
                                        </span>
                                    </td>
                                    <td>
                                        <div>
                                            {{ item.qty }} * {{ item.product_price }}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="price">
                                            {{ item.product_price * item.qty }}
                                        </div>
                                    </td>

                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
            <div v-else>
                <h2 class="text-center">No order found</h2>
            </div>
        </div>
    </ProfileLayout>
</template>

<script>
import ProfileLayout from "../shared/ProfileLayout.vue";
export default {
    components: { ProfileLayout },
    data: () => ({
        bread_cumb: [
            {
                title: 'profile',
                url: '/profile',
                active: false,
            },
            {
                title: 'orders',
                url: '/profile/orders',
                active: true,
            },
        ],
        order_list: []
    }),
    created: async function () {
        await this.get_all_orders();
    },
    methods: {
        get_all_orders: async function () {
            let response = await window.privateAxios('/get-all-customer-ecommerce-order');
            this.order_list = response.data;
            console.log("dd", this.order_list);

        },
        load_image: window.load_image,
    },

};
</script>

<style></style>
