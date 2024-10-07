<template>
    <Layout>
        <div class="breadcrumb-main ">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="breadcrumb-contain">
                            <div>
                                <h2>cart</h2>
                                <ul>
                                    <li><a href="javascript:void(0)">home</a></li>
                                    <li><i class="fa fa-angle-double-right"></i></li>
                                    <li><a href="javascript:void(0)">cart</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <section class="cart-section section-big-py-space b-g-light">
            <div class="custom-container">
                <div class="row">
                    <div class="col-sm-12">
                        <table class="table cart-table table-responsive-xs">
                            <thead>
                                <tr class="table-head">
                                    <th scope="col">action</th>
                                    <th scope="col">image</th>
                                    <th scope="col">product name</th>
                                    <th scope="col">price</th>
                                    <th scope="col">quantity</th>
                                    <th scope="col">total</th>
                                </tr>
                            </thead>

                            <tbody>
                                <template v-if="all_cart_data.length > 0">
                                    <tr v-for="cart in all_cart_data" :key="cart.id">
                                        <td><a href="javascript:void(0)" @click="remove_cart_item(cart.id)"
                                                class="icon"><i class="ti-close"></i></a></td>
                                        <td class="d-flex justify-content-center">
                                            <div class="bg-dummy-image"
                                                style="height: 100px;width: 100px;background-color: white;">
                                                <Link :href="`/product-details/${cart?.product?.slug}`">
                                                <img class="w-100 h-100"
                                                    :src="load_image(`${cart.product.product_image?.url}`)" alt="cart">
                                                </Link>
                                            </div>
                                        </td>
                                        <td style="width: 100px">
                                            <Link :href="`/product-details/${cart?.product?.slug}`">{{
                                                cart.product.title }}
                                            </Link>

                                        </td>
                                        <td>
                                            <h2>{{ get_price(cart.product).new_price }} ৳ </h2>
                                        </td>
                                        <td>
                                            <template v-if="cart.product.type == 'medicine'">
                                                <div class="qty-box">
                                                    <div class="input-group">
                                                        <select
                                                            @change="cart_quantity_update(cart.id, null, $event.target.value)"
                                                            name="quantity" id="" class="form-select"
                                                            v-model="cart.quantity">
                                                            <option
                                                                v-for="data in cart.product?.medicine_product_verient?.pv_b2c_max_qty"
                                                                :key="data" :value="data">
                                                                {{ data }} x {{
                                                                    cart.product?.medicine_product_verient?.pu_b2c_sales_unit_label
                                                                }}
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </template>
                                            <template v-else>
                                                <div class="qty-box">
                                                    <div class="input-group">
                                                        <input type="number" name="quantity" min="1"
                                                            class="form-control input-number" v-model="cart.quantity"
                                                            @keyup="
                                                                cart_quantity_update(
                                                                    cart.id,
                                                                    null,
                                                                    $event.target.value
                                                                )
                                                                ">
                                                    </div>
                                                </div>
                                            </template>

                                        </td>

                                        <td>
                                            <h2 class="td-color">
                                                {{ cart.quantity * get_price(cart.product).new_price }} ৳
                                            </h2>
                                        </td>
                                    </tr>
                                </template>

                                <template v-else>
                                    <tr>
                                        <td colspan="6">
                                            <h2 class="td-color text-center">No item found in cart</h2>
                                        </td>
                                    </tr>
                                </template>

                            </tbody>

                        </table>
                        <table class="table cart-table table-responsive-md">
                            <tfoot>
                                <tr>
                                    <td>total price :</td>
                                    <td>
                                        <h2>{{ total_cart_price }} ৳</h2>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="row cart-buttons">
                    <div class="col-12">
                        <Link href="/" class="btn btn-normal">continue shopping</Link>
                        <Link v-if="all_cart_data.length > 0" href="/checkout" class="btn btn-normal ms-3">check out
                        </Link>
                    </div>
                </div>
            </div>
        </section>
    </Layout>
</template>

<script>
import Layout from "../../Shared/Layout.vue";
import { mapActions, mapState } from "pinia";
import { common_store } from "../../Store/common_store";
import { auth_store } from "../../Store/auth_store";
export default {
    components: { Layout },

    created: async function () {
        await this.check_is_auth();
        if (!this.is_auth) {
            this.$inertia.visit("/login");
        }
    },
    methods: {
        ...mapActions(common_store, {
            remove_cart_item: "remove_cart_item",
            cart_quantity_update: "cart_quantity_update",
        }),
        ...mapActions(auth_store, {
            "check_is_auth": "check_is_auth",
        }),
        load_image: window.load_image,
    },

    computed: {
        ...mapState(common_store, {
            all_cart_data: "all_cart_data",
            total_cart_price: "total_cart_price",
            get_price: "get_price",
        }),
        ...mapState(auth_store, {
            "is_auth": "is_auth",
        }),
    },
};
</script>

<style></style>
