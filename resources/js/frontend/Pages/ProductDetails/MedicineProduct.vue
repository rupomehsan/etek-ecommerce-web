<template>
    <div class="custom-container">
        <div class="medicine_details_row">
            <div class="left_image_part">
                <div class="product_medicine_image">
                    <a :href="load_image(`${product_initial_data.product_image?.url}`)" data-lightbox="prouct-set"
                        data-title="Product image" class="bg-white">
                        <img :src="load_image(`${product_initial_data.product_image?.url}`)"
                            :alt="product_initial_data.product_image?.url" class="img-fluid image_zoom_cls-0">
                    </a>
                </div>

                <div class="c-bg-primary mt-3" style="border-radius: 5px;">
                    <div class="d-flex p-3 gap-2">
                        <p class="single-product-title text-white fw-bold">
                            ফার্মেসীর জন্য পাইকারি দামে ঔষধ কিনতে রেজিস্টেশন করুন
                        </p>
                        <div>
                            <Link href="/retailer-register" type="button" class="btn btn-solid btn-sm ">
                            Register
                            </Link>
                        </div>
                    </div>
                </div>
            </div>

            <div class="product_medicine_information">
                <h1>
                    {{ product_initial_data.title }}
                </h1>
                <table class="info_table">
                    <tbody>
                        <tr>
                            <th>
                                Type
                            </th>
                            <td>
                                {{ product_initial_data.medicine_type }}
                            </td>
                        </tr>
                        <tr v-if="product_initial_data.product_brand">
                            <th>
                                Brand
                            </th>
                            <td>
                                {{ product_initial_data.product_brand?.title }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Geniric
                            </th>
                            <td>
                                {{ product_initial_data.product_generic?.title }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Unit
                            </th>
                            <td>
                                {{ product_initial_data.product_unit?.title }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Is Antibiotic
                            </th>
                            <td>
                                {{ product_initial_data.is_antibiotic ? 'Yes' : 'no' }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Manufacturer
                            </th>
                            <td>
                                {{ product_initial_data.product_manufaturer?.title }}
                            </td>
                        </tr>
                    </tbody>
                </table>

                <div class="single-product-info">
                    <div class="ps-3">
                        <h6 class="product-title d-block mt-3">quantity</h6>
                        <div class="qty-box">
                            <div class="input-group">
                                <button class="qty-minus" @click="AdujustQuantity('minus')"></button>
                                <input class="qty-adj form-control" type="number" min="1" v-model="quantity" />
                                <button class="qty-plus" @click="AdujustQuantity('plus')"></button>
                            </div>
                        </div>
                    </div>
                    <div class="product-buttons ps-3 d-flex flex-wrap gap-2 mt-4">
                        <button @click="add_to_cart(product_initial_data, +quantity)" class="btn btn-normal">
                            <i class="icon icon-shopping-cart"></i>
                            Add to Cart

                            <span v-if="is_in_cart(product_initial_data).status" class="d-none">
                                {{ set_default_qty(is_in_cart(product_initial_data).qty) }}
                                ( {{ is_in_cart(product_initial_data).qty }} )
                            </span>

                        </button>
                        <a @click="is_auth ? add_to_wish_list(product_initial_data.id) : openAccount()"
                            class="btn px-4 btn-normal btn-outline add-to-wish tooltip-top"
                            data-tippy-content="Add to wishlist">
                            <i class="fa fa-heart" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="related_products">
                <h2 class="heading">
                    Similar Medicines
                </h2>
                <div class="product_items">
                    <template v-for="r_product in product_initial_data.related_products" :key="r_product.id">
                        <LeftProductItem :product="r_product" />
                    </template>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h2 class="medicine_description_title">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <g>
                            <path
                                d="M18.375 22.075L19.525 20.925L15.075 16.475L13.925 17.625C13.3083 18.2417 13 18.9833 13 19.85C13 20.7167 13.3083 21.4583 13.925 22.075C14.5417 22.6917 15.2833 23 16.15 23C17.0167 23 17.7583 22.6917 18.375 22.075ZM20.925 19.525L22.075 18.375C22.6917 17.7583 23 17.0167 23 16.15C23 15.2833 22.6917 14.5417 22.075 13.925C21.4583 13.3083 20.7167 13 19.85 13C18.9833 13 18.2417 13.3083 17.625 13.925L16.475 15.075L20.925 19.525ZM7 9H17V7H7V9ZM12 4.25C12.2167 4.25 12.3958 4.17917 12.5375 4.0375C12.6792 3.89583 12.75 3.71667 12.75 3.5C12.75 3.28333 12.6792 3.10417 12.5375 2.9625C12.3958 2.82083 12.2167 2.75 12 2.75C11.7833 2.75 11.6042 2.82083 11.4625 2.9625C11.3208 3.10417 11.25 3.28333 11.25 3.5C11.25 3.71667 11.3208 3.89583 11.4625 4.0375C11.6042 4.17917 11.7833 4.25 12 4.25ZM11.125 21H5C4.45 21 3.97917 20.8042 3.5875 20.4125C3.19583 20.0208 3 19.55 3 19V5C3 4.45 3.19583 3.97917 3.5875 3.5875C3.97917 3.19583 4.45 3 5 3H9.2C9.41667 2.4 9.77917 1.91667 10.2875 1.55C10.7958 1.18333 11.3667 1 12 1C12.6333 1 13.2042 1.18333 13.7125 1.55C14.2208 1.91667 14.5833 2.4 14.8 3H19C19.55 3 20.0208 3.19583 20.4125 3.5875C20.8042 3.97917 21 4.45 21 5V11.125C20.3 10.9583 19.6042 10.9458 18.9125 11.0875C18.2208 11.2292 17.5833 11.4917 17 11.875V11H7V13H15.725L13.725 15H7V17H11.875C11.4917 17.5833 11.2292 18.2208 11.0875 18.9125C10.9458 19.6042 10.9583 20.3 11.125 21Z"
                                fill="currentColor">
                            </path>
                        </g>
                    </svg>
                    {{ product_initial_data.title }}
                </h2>
            </div>
            <div class="card-body">
                <div class="product_medicine_description">
                    <div v-html="product_initial_data?.description"></div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>

import Layout from "../../Shared/Layout.vue";
import { useProductDetailsStore } from './Store/product_details_store.js';
import ProductBasicInfo from './Components/ProductBasicInfo.vue';
import ProductBottomDetails from './Components/ProductBottomDetails.vue';
import TopProducts from './Components/TopProducts.vue';
import { mapActions, mapState, mapWritableState } from 'pinia';
import ProductImage from './Components/ProductImage.vue';
import BreadCumb from '../../Components/BreadCumb.vue';
import { common_store } from "../../Store/common_store";
import { cart_store } from '../../Store/cart_store';
import LeftProductItem from "../../Components/LeftProductItem.vue";
export default {
    components: {
        BreadCumb, Layout, ProductBasicInfo,
        ProductBottomDetails, TopProducts,
        ProductImage,
        LeftProductItem,
    },
    props: {
        slug: String,
    },
    data: () => ({
        loaded: false,
        product: null,
        bread_cumb: [
            {
                title: 'product-details',
                url: '#',
                active: false,
            },
        ],
        is_availablity_show: false,
        is_share_show: false,
        is_originality_show: false,
        genericModal: false,

        is_auth: false,
        quantity: 1,

    }),
    watch: {
        quantity: function (v) {
            this.add_to_cart(this.product_initial_data, v);
        }
    },
    created: async function () {
        this.is_auth = localStorage.getItem("token") ? true : false;
    },
    methods: {
        ...mapActions(common_store, {
            add_to_wish_list: "add_to_wish_list",
            get_all_cart_data: "get_all_cart_data",
        }),
        ...mapActions(useProductDetailsStore, {
            get_related_generic_products: "get_related_generic_products",
        }),
        load_image: window.load_image,
        genericProducts: function () {
            this.genericModal = true
        },
        ...mapActions(cart_store, [
            "add_to_cart",
            "is_in_cart",
        ]),
        set_default_qty: function (qty) {
            this.quantity = qty;
        },
        AdujustQuantity: function (type) {
            if (type == "plus") {
                this.quantity++;
            } else {
                if (this.quantity > 1) {
                    this.quantity--;
                }
            }
        },

        copyLink() {
            const link = window.location.href; // You can replace this with the specific URL you want to copy
            navigator.clipboard.writeText(link).then(() => {
                alert('Link copied to clipboard!');
            }).catch(err => {
                console.error('Failed to copy: ', err);
            });
        },
        shareOnFacebook() {
            const url = encodeURIComponent(window.location.href); // URL to share
            window.open(`https://www.facebook.com/sharer/sharer.php?u=${url}`, '_blank');
        },
        shareOnTwitter() {
            const url = encodeURIComponent(window.location.href); // URL to share
            const text = encodeURIComponent("Check this out!"); // Optional tweet text
            window.open(`https://twitter.com/intent/tweet?url=${url}&text=${text}`, '_blank');
        },
        shareOnLinkedIn() {
            const url = encodeURIComponent(window.location.href); // URL to share
            window.open(`https://www.linkedin.com/shareArticle?mini=true&url=${url}`, '_blank');
        }
    },


    computed: {
        ...mapWritableState(useProductDetailsStore, {
            // product_details: 'product_details',
            product_initial_data: 'product_initial_data',
            related_generic_products_data: 'related_generic_products_data',
        })
    }


};
</script>
