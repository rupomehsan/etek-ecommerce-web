<template>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td class="title">
                                <img :src="`${load_image(get_setting_value('header_logo'))}`"
                                    style="width: 100%; max-width: 150px" />
                            </td>

                            <td>
                                Invoice #: <span class="fw-bold"> {{ order_info.order_id }}</span><br />
                                Date : {{ new Date(order_info.created_at).toDateString() }}<br />
                                Payment status : {{ order_info.paid_status }}<br />
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="information">
                <td style="width: 50%">
                    <h4>Delivery Information</h4><br>
                    {{ order_info.delivery_address_details?.address }}.<br />
                    {{ order_info.delivery_address_details?.station_name }} ,
                    {{ order_info.delivery_address_details?.district_name }}, {{
                        order_info.delivery_address_details?.division_name }} <br><br>
                </td>

                <td>
                    <h4>User Information</h4><br>
                    Name : {{ order_info.delivery_address_details?.user_name }}.<br />
                    Email : {{ order_info.delivery_address_details?.email }}<br />
                    Phone : {{ order_info.delivery_address_details?.phone }}
                </td>
            </tr>

            <tr class="heading ">
                <td>Item</td>
                <!-- <td>Quantity</td> -->
                <td>Price</td>
            </tr>

            <tr class="item" v-for="item in order_info.order_products" :key="item.id">
                <td>{{ item.product_name }}</td>
                <td>{{ item.qty }} x {{ Math.round(item.price) }} = {{ Math.round(item.price) * item.qty }}
                </td>
            </tr>
            <tr class="total">
                <td></td>

                <td>Sub total: {{ Math.round(order_info.subtotal) }}</td>
            </tr>
            <tr class="total">
                <td></td>

                <td>Delivery charge: {{ order_info.delivery_charge }}</td>
            </tr>
            <tr class="total">
                <td></td>

                <td>Total: {{ Math.round(order_info.total) }}</td>
            </tr>
        </table>
    </div>
    <div class="text-center p-d-none">
        <button id="printBtn" @click="printInvoice"
            class="btn btn-success mt-3 fw-bold text-white  py-2 px-5 my-5">Print
            Invoice
        </button>
        <a href="/" class="btn btn-info mt-3 fw-bold text-white ms-2 ml-2 py-2 px-5 my-5">
            Back To Shopping
        </a>
    </div>
</template>

<script>
import { mapActions, mapState } from 'pinia';
import { common_store } from "../../Store/common_store";
export default {

    props: {
        order_info: Object
    },

    created: async function () {
        await this.get_all_website_settings();
    },
    methods: {
        ...mapActions(common_store, {
            get_setting_value: "get_setting_value",
            get_all_website_settings: "get_all_website_settings",
        }),
        printInvoice() {
            window.print();
        },
        load_image: window.load_image,
    },

}
</script>

<style>
.invoice-box {
    max-width: 800px;
    margin: auto;
    padding: 30px;
    border: 1px solid #eee;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
    font-size: 16px;
    line-height: 24px;
    font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
    color: #555;
}

.invoice-box table {
    width: 100%;
    line-height: inherit;
    text-align: left;
}

.invoice-box table td {
    padding: 5px;
    vertical-align: top;
}

.invoice-box table tr td:nth-child(2) {
    text-align: right;
}

.invoice-box table tr.top table td {
    padding-bottom: 20px;
}

.invoice-box table tr.top table td.title {
    font-size: 45px;
    line-height: 45px;
    color: #333;
}

.invoice-box table tr.information table td {
    padding-bottom: 40px;
}

.invoice-box table tr.heading td {
    background: #eee;
    border-bottom: 1px solid #ddd;
    font-weight: bold;
}

.invoice-box table tr.details td {
    padding-bottom: 20px;
}

.invoice-box table tr.item td {
    border-bottom: 1px solid #eee;
}

.invoice-box table tr.item.last td {
    border-bottom: none;
}

.invoice-box table tr.total td:nth-child(2) {
    border-top: 2px solid #eee;
    font-weight: bold;
}


/** RTL **/
.invoice-box.rtl {
    direction: rtl;
    font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
}

.invoice-box.rtl table {
    text-align: right;
}

.invoice-box.rtl table tr td:nth-child(2) {
    text-align: left;
}

.payment-status h1 {
    color: #88B04B;
    font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
    font-weight: 900;
    font-size: 40px;
    margin-bottom: 10px;
}

.payment-status p {
    color: #404F5E;
    font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
    font-size: 20px;
    margin: 0;
}

.payment-status .icon-part {
    border-radius: 200px;
    height: 100px;
    width: 100px;
    background: rgb(19 99 14);
    margin: 0px auto;
}

.payment-status i {
    color: #9ABC66;
    font-size: 40px;
    line-height: 200px;
    margin-left: -15px;
}

.payment-status {
    max-width: 800px;
    margin: auto;
    padding: 30px;
    border: 1px solid #eee;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
    font-size: 16px;
    line-height: 24px;
    font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
    color: #555;
    text-align: center;

}

@media only screen and (max-width: 600px) {
    .invoice-box table tr.top table td {
        width: 100%;
        display: block;
        text-align: center;
    }

    .invoice-box table tr.information table td {
        width: 100%;
        display: block;
        text-align: center;
    }
}

@media print {
    .p-d-none {
        display: none;
    }

    .invoice-box {
        box-shadow: none;
    }
}
</style>
