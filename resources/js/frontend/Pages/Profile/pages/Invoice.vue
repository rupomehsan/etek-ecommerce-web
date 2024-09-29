<template>
    <div class="payment-status my-3 p-d-none">
        <div class="d-flex align-items-center justify-content-center icon-part">
            <i class="checkmark">✓</i>
        </div>
        <h1>Success</h1>
        <p class="fw-bold">Your payment was successful</p>

    </div>

    <order-invoice :order_info="order_info"></order-invoice>

</template>

<script>
import OrderInvoice from '../../../Components/Invoice/OrderInvoice.vue';
export default {
    components: { OrderInvoice },
    data: () => ({
        order_id: null,
        order_info: {}
    }),

    created: async function () {
        const fullUrl = this.$page.url;
        const urlParams = new URLSearchParams(fullUrl.split('?')[1]);
        this.order_id = urlParams.get('order_id');

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
