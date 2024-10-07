<template>
    <div class="theme-card creative-card creative-inner related_product_card">
        <h5 class="title-border">Related Products</h5>
        <div class="media-banner plrb-0 b-g-white1 border-0">
            <template v-if="product.related_products?.length">
                <div class="media-banner-box" v-for="item in product.related_products" :key="item.id">
                    <div class="media">
                        <Link :href="`/product-details/${item.slug}`" tabindex="0">
                        <img :src="load_image(`${item.product_image?.url}`)" height="100" width="100" class="img-fluid"
                            alt="banner">
                        </Link>
                        <div class="media-body">
                            <div class="media-contant">
                                <div>
                                    <div class="product-detail">
                                        <ul class="rating">

                                            <li>
                                                <i class="fa fa-star" v-for="n in 5" :key="n"
                                                    :class="{ active: n <= item.average_rating }">
                                                </i>
                                            </li>

                                        </ul>
                                        <Link :href="`product-details/${item.slug}`" tabindex="0">
                                            <p>{{ item.title }}</p>
                                        </Link>
                                        <template v-if="item.current_price > 0">
                                            <h6>$ {{ item.current_price }} <span>$ {{ item.customer_sales_price
                                                    }}</span>
                                            </h6>
                                        </template>

                                    </div>
                                    <div class="cart-info">
                                        <button class="tooltip-top add-cartnoty" @click="add_to_cart(item.id)">
                                            <i class="fa fa-shopping-cart"></i>
                                        </button>
                                        <Link :href="`/product-details/${item.slug}`" tabindex="0">
                                        <i class="fa fa-eye"></i>
                                        </Link>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </template>

        </div>
    </div>
</template>

<script>
import { mapActions } from 'pinia';
import { common_store } from '../../../Store/common_store';
export default {
    props: {
        product: Object
    },

    methods: {
        ...mapActions(common_store, {
            add_to_cart: "add_to_cart",
        }),

        load_image: window.load_image,
    }
}
</script>

<style>
.product-detail .fa-star {
    cursor: pointer;
    color: #d3d3d3 !important;
    font-size: 20px !important;
}

.product-detail .fa-star.active {
    color: #ffc107 !important;
    font-size: 20px !important;
}
</style>
