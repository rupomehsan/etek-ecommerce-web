<template>
    <ProfileLayout :bread_cumb="bread_cumb">
        <order-invoice :order_info="order_info"></order-invoice>
    </ProfileLayout>
</template>

<script>
import OrderInvoice from '../../../Components/Invoice/OrderInvoice.vue';
import ProfileLayout from "../shared/ProfileLayout.vue";
export default {
    components: { ProfileLayout, OrderInvoice },
    props: {
        order_id: String,
    },
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
        order_info: {}
    }),
    created: async function () {
        await this.get_single_order_details();
    },
    methods: {
        get_single_order_details: async function () {
            let response = await window.privateAxios('/get-single-order-details/' + this.order_id);
            this.order_info = response.data;


        },

    },

};
</script>
