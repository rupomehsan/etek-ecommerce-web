<template>
    <Layout>
        <div class="breadcrumb-main ">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="breadcrumb-contain">
                            <div>
                                <h2>checkout</h2>
                                <ul>
                                    <li><a href="/">home</a></li>
                                    <li><i class="fa fa-angle-double-right"></i></li>
                                    <li><a href="javascript:void(0)">checkout</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <section class="section-big-py-space b-g-light">
            <div class="custom-container">
                <div class="checkout-page contact-page">
                    <div class="checkout-form">
                        <form @submit.prevent="checkoutFormSubmit($event)">
                            <div class="row">
                                <div class="col-lg-6 col-sm-12 col-xs-12">
                                    <div class="theme-form">
                                        <div class="row check-out ">
                                            <div class="checkout-title text-center">
                                                <h3>Billing & Shiping Details</h3>

                                                <hr>
                                            </div>
                                            <div class="form-group col-md-12 col-sm-16 col-xs-12">
                                                <input type="hidden" name="address_id"
                                                    :value="user_info?.user_delivery_address?.id" id="">
                                                <label>User full Name</label>
                                                <input type="text" name="user_name" id="user_name"
                                                    :value="`${user_info?.name}`" placeholder="">
                                            </div>

                                            <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                                <label class="field-label">Phone</label>
                                                <input type="text" name="phone" id="phone"
                                                    :value="user_info?.phone_number" placeholder="">
                                            </div>
                                            <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                                <label class="field-label">Email Address</label>
                                                <input type="text" name="email" id="email" :value="user_info?.email"
                                                    placeholder="">
                                            </div>
                                            <!-- <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                <label class="field-label">Country</label>
                                                <select name="country">
                                                    <option>India</option>
                                                    <option>South Africa</option>
                                                    <option>United State</option>
                                                    <option>Australia</option>
                                                </select>
                                            </div> -->
                                            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                <label class="field-label">Address</label>
                                                <input type="text" name="address" id="address" v-model="address"
                                                    placeholder="Street address">
                                            </div>
                                            <div class="form-group required">
                                                <label for="state_division_id">Division</label>
                                                <select name="state_division_id" id="state_division_id"
                                                    class="form-control" v-model="state_division_id">
                                                    <option value=""> --- Please Select --- </option>
                                                    <option v-for="(division, index) in divisions" :key="index"
                                                        :value="division.id"
                                                        :selected="division.id == user_address_info?.state_division_id ? 'selected' : ''">
                                                        {{
                                                            division.name }}</option>
                                                </select>
                                            </div>
                                            <div class="form-group required">
                                                <label for="district_id">District</label>
                                                <select name="district_id" id="district_id" class="form-control"
                                                    v-model="district_id" :disabled="isSelectDistrictDisabled">
                                                    <option value=""> --- Please Select --- </option>
                                                    <option v-for="(district, index) in districts" :key="index"
                                                        :value="district.id" :selected="false">{{ district.name }}
                                                    </option>
                                                </select>
                                            </div>

                                            <div class="form-group required">
                                                <label for="station_id">Station</label>
                                                <select name="station_id" id="station_id" class="form-control"
                                                    v-model="station_id" :disabled="isSelectStationDisabled">
                                                    <option value=""> --- Please Select --- </option>
                                                    <option v-for="(station, index) in stations" :key="index"
                                                        :value="station.id" :selected="false">{{ station.name }}
                                                    </option>
                                                </select>
                                            </div>
                                            <!-- <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <input type="checkbox" name="shipping-option" id="account-option">
                                                <label for="account-option">Create An Account?</label>
                                            </div> -->
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-12 col-xs-12">
                                    <div class="checkout-details theme-form  ">
                                        <div class="order-box">
                                            <div class="checkout-title text-center">
                                                <h3>Order Details</h3>
                                                <hr>
                                            </div>
                                            <table v-if="all_cart_data.length"
                                                class="table cart-table table-responsive-xs">
                                                <thead>
                                                    <tr class="table-head">
                                                        <th scope="col">Product</th>
                                                        <th scope="col">Price</th>
                                                        <th scope="col">Quantity</th>
                                                        <th scope="col">Total</th>
                                                    </tr>
                                                </thead>

                                                <tbody class="">
                                                    <tr v-for="cart in all_cart_data" :key="cart.id">

                                                        <td width="250px">
                                                            <Link :href="`/product-details/${cart?.product?.slug}`">{{
                                                                cart.product.title }}
                                                            </Link>
                                                        </td>
                                                        <td>
                                                            <p>{{ get_price(cart?.product).new_price }}</p>
                                                        </td>
                                                        <td>
                                                            <p>{{ cart.quantity }}</p>
                                                        </td>

                                                        <td>
                                                            <p class="td-color">{{ cart.quantity *
                                                                get_price(cart?.product).new_price }}</p>
                                                        </td>
                                                    </tr>
                                                </tbody>

                                                <tfoot>
                                                    <tr>
                                                        <td colspan="3">
                                                            <h5>Subtotal</h5>
                                                        </td>

                                                        <td>
                                                            <h5>{{ total_cart_price }} ৳ </h5>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="3">
                                                            <div
                                                                class=" d-flex align-items-center justify-content-between">
                                                                <h5>
                                                                    Shipping
                                                                </h5>
                                                                <select v-model="delivery_charge" name="delivery_charge"
                                                                    class="w-25">
                                                                    <option v-for="option in deliveryChargeOptions"
                                                                        :key="option.value" :value="option.value">
                                                                        {{ option.label }}
                                                                    </option>
                                                                </select>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class=" d-flex ">
                                                                <!-- <div class="shopping-option">
                                                                    <input type="checkbox" name="free-shipping"
                                                                        id="free-shipping">
                                                                    <label for="free-shipping">Free Shipping</label>
                                                                </div>
                                                                <div class="shopping-option">
                                                                    <input type="checkbox" name="local-pickup"
                                                                        id="local-pickup">
                                                                    <label for="local-pickup">Local Pickup</label>
                                                                </div> -->

                                                                <h5>{{ delivery_charge }} ৳</h5>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="3">
                                                            <h5>Grand Total</h5>
                                                        </td>

                                                        <td>
                                                            <h5>{{ total_cart_price + Number(delivery_charge) }} ৳</h5>
                                                        </td>
                                                    </tr>
                                                </tfoot>
                                            </table>

                                        </div>
                                        <div v-if="all_cart_data.length" class="payment-box">
                                            <div class="upper-box">
                                                <div class="payment-options">
                                                    <ul>
                                                        <ul>
                                                            <li>
                                                                <div class="radio-option">
                                                                    <input type="radio" v-model="payment_type"
                                                                        name="payment_type" value="cod"
                                                                        id="payment-cod">
                                                                    <label for="payment-cod">
                                                                        Cash On Delivery

                                                                    </label>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="radio-option paypal">
                                                                    <input type="radio" v-model="payment_type"
                                                                        value="online" name="payment_type"
                                                                        id="payment-online">
                                                                    <label for="payment-online">
                                                                        Online Payment
                                                                    </label>
                                                                </div>
                                                            </li>
                                                        </ul>

                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="text-right">
                                                <button type="submit" class="btn-normal btn">Place Order</button>
                                            </div>

                                        </div>
                                        <div v-else class="text-center">
                                            <h3 class="my-3">No product in cart</h3>
                                            <Link href="/" class="btn-normal btn">Continue shopping</Link>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

    </Layout>
</template>

<script>
import axios from "axios";
import Layout from "../../Shared/Layout.vue";
import { mapActions, mapState } from "pinia";
import { common_store } from "../../Store/common_store";
import { auth_store } from "../../Store/auth_store.js";
import { computed, ref } from "vue"
export default {
    components: { Layout },
    data: () => ({
        user_address_info: {},

        isSelectDistrictDisabled: true,
        isSelectStationDisabled: true,

        divisions: null,
        districts: null,
        stations: null,

        state_division_id: '',
        district_id: '',
        station_id: '',
        delivery_charge: 0,
        payment_type: 'cod',
        payment_link: "",
        outside_dhaka: 0,
        inside_dhaka: 0,
        getDeliveryCharge: null,

        address: '',

    }),

    setup() {
        const authStore = auth_store();
        const user_info = computed(() => authStore.auth_info);
        return { user_info };
    },

    created: async function () {

        const authStore = auth_store();
        await authStore.check_is_auth();

        if (!authStore.is_auth) {
            this.$inertia.visit('/login');
        } else {

            await this.all_division();
            this.user_address_info = authStore.auth_info?.user_delivery_address
            this.state_division_id = this.user_address_info?.state_division_id
            this.district_id = this.user_address_info?.district_id
            this.station_id = this.user_address_info?.station_id
            this.address = this.user_info?.user_delivery_address?.address

            this.getDeliveryCharge = this.get_setting_value('delivery_charge', true);
            if (this.getDeliveryCharge && this.getDeliveryCharge.length >= 2) {
                this.inside_dhaka = this.getDeliveryCharge[0].value || 0;
                this.outside_dhaka = this.getDeliveryCharge[1].value || 0;
                this.delivery_charge = this.inside_dhaka
            }


        }


    },



    methods: {

        ...mapActions(common_store, {
            remove_cart_item: "remove_cart_item",
            cart_quantity_update: "cart_quantity_update",
            get_setting_value: "get_setting_value",
            get_price: "get_price",
        }),

        checkoutFormSubmit: async function ($event) {
            let formData = new FormData($event.target);
            let response = await window.privateAxios('/customer-ecommerce-order-placed', 'post', formData);
            if (response.status === "success") {
                if (response.data.order_details?.payment_method === 'cod') {
                    window.s_alert(response.message);
                    window.location.href = `profile/order-details/${response.data?.order_details?.order_id}`
                } else if (response.data.order_details?.payment_method === 'online') {
                    this.checkoutPopUp(response.data)
                }
            }
        },

        all_division: async function () {
            let response = await axios.get('/state-divisions', {
                params: {
                    sort_by_col: 'id',
                    sort_type: 'asc',
                    status: 'active',
                    fields: ['id', 'name'],
                    get_all: 1,
                }
            })
            if (response.data.status === 'success') {
                this.divisions = response.data.data
            }
        },
        get_district_by_state_division_id: async function (state_division_id) {
            let response = await axios.get(`/get-district-by-division-id/${state_division_id}`, {
                params: {
                    sort_by_col: 'id',
                    sort_type: 'asc',
                    status: 'active',
                    fields: ['id', 'name']
                }
            })
            if (response.data.status === 'success') {
                this.districts = response.data.data
                this.isSelectDistrictDisabled = false;
            }

        },
        get_station_by_district_id: async function (district_id) {
            let response = await axios.get(`/get-station-by-district-id/${district_id}`, {
                params: {
                    sort_by_col: 'id',
                    sort_type: 'asc',
                    status: 'active',
                    fields: ['id', 'name']
                }
            })
            if (response.data.status === 'success') {
                this.stations = response.data.data
                this.isSelectStationDisabled = false;
            }

        },

        checkoutPopUp: async function (data) {

            let payment_res = await window.axios.get(`pay-via-ajax?order_id=${data.order_details.order_id}`);
            this.payment_link = payment_res.data?.data;
            window.location.href = this.payment_link;
            // window.open(this.payment_link, "_blank");

        }

    },


    watch: {
        state_division_id: function (divisionId) {
            if (divisionId) {
                this.get_district_by_state_division_id(divisionId);
            }
        },
        district_id: function (districtId) {
            if (districtId) {
                this.get_station_by_district_id(districtId);
            }
        },

    },

    computed: {
        ...mapState(common_store, {
            all_cart_data: "all_cart_data",
            total_cart_price: "total_cart_price",

            website_settings_data: "website_settings_data",
        }),
        deliveryChargeOptions() {
            return [
                { label: 'Inside Dhaka', value: this.inside_dhaka },
                { label: 'Outside Dhaka', value: this.outside_dhaka }
            ];
        }
    },
};
</script>
