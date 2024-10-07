<template>
    <div class="invoice-box" v-if="order_info?.order_products?.length && Object.keys(order_info).length">
        <table cellpadding="0" cellspacing="0">
            <thead>
                <tr class="top">
                    <td colspan="4">
                        <table>
                            <tr>
                                <td class="title">
                                    <img :src="`${load_image(get_setting_value('header_logo'))}`"
                                        style="width: 100%; max-width: 150px" />
                                </td>

                                <td style="white-space: nowrap;">
                                    Invoice #: <span class="fw-bold"> {{ order_info?.order_id }}</span><br />
                                    Date : {{ new Date(order_info?.created_at).toDateString() }}<br />
                                    Payment status : {{ order_info?.paid_status }}<br />
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr class="information">
                    <td colspan="2">
                        <div class="delivery_address">
                            <h4>Delivery Address</h4><br>
                            {{ get_address_data('address') }}.<br />
                            {{ get_address_data('station_name') }} ,
                            {{ get_address_data('district_name') }},
                            {{ get_address_data('division_name') }} <br><br>
                        </div>
                    </td>

                    <td colspan="2">
                        <h4>Customer Information</h4><br>
                        {{ get_address_data('user_name') }}.<br />
                        <span v-if="get_address_data('email')">
                            {{ get_address_data('email') }}<br />
                        </span>
                        {{ get_address_data('phone') }}
                        <br />
                    </td>
                </tr>
                <tr class="heading ">
                    <th>Item</th>
                    <th style="width: 100px;">Quantity</th>
                    <th style="width: 100px;">Unit Price</th>
                    <th style="width: 100px;" class="text-end">Price</th>
                </tr>
            </thead>

            <tbody>
                <tr class="item" v-for="item in order_info.order_products" :key="item.id">

                    <td>
                        <div class="product_title">
                            {{ item.product_name }}
                        </div>
                    </td>
                    <td>{{ item.qty }}</td>
                    <td style="white-space: nowrap;">{{ print_number(item.price) }} ৳</td>
                    <td style="white-space: nowrap;">
                        {{ print_number( item.price * item.qty ) }} ৳
                    </td>
                </tr>
            </tbody>

            <tfoot>
                <tr class="total">
                    <td colspan="3" class="text-end pe-4">
                        Sub total
                    </td>
                    <td style="white-space: nowrap;"> {{ print_number(order_info?.subtotal) }} ৳</td>
                </tr>
                <tr class="total">
                    <td colspan="3" class="text-end pe-4">Delivery charge</td>
                    <td style="white-space: nowrap;"> {{ print_number(order_info?.delivery_charge) }} ৳</td>
                </tr>
                <tr class="total">
                    <td colspan="3" class="text-end pe-4">Total:</td>
                    <td style="white-space: nowrap;">{{ print_number(order_info?.total) }} ৳</td>
                </tr>
            </tfoot>
        </table>
    </div>
    <div class="text-center p-d-none">
        <button id="printBtn" @click="printInvoice"
            class="btn btn-success mt-3 fw-bold text-white  py-2 px-5 my-5">Print
            Invoice
        </button>
        <Link href="/" class="btn btn-info mt-3 fw-bold text-white ms-2 ml-2 py-2 px-5 my-5">
            Back To Shopping
        </Link>
    </div>
</template>

<script>
import { mapActions, mapState } from 'pinia';
import { common_store } from "../../Store/common_store";
export default {

    props: {
        order_info: Object,
        default: {},
    },

    created: async function () {
        // await this.get_all_website_settings();
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

        get_address_data: function(key='user_name'){
            let address = this.order_info.delivery_address_details;
            try {
                address = JSON.parse(address);
            } catch (error) {
                address = this.order_info.delivery_address_details;
            }
            if(address){
                return address[key];
            }

            return '';
        },

        print_number: function(value){
            if(value && !isNaN(value)){
                return  this.number_format(Math.round(value))
            }
            return value;
        }
    },

}
</script>

