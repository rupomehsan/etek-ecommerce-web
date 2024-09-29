<template>
    <ProfileLayout :bread_cumb="bread_cumb">
        <div class="dashboard">
            <div class="page-title">
                <h2>
                    Compare List
                </h2>
                <hr>
            </div>
            <div class="box-account box-info">
                <div class="table-responsive">
                    <template v-if="all_compare_list_data.length > 0">
                        <table class="product_info_table table table-bordered mb-0">
                            <tr v-for="item in all_compare_list_data" :key="item.id">
                                <td>
                                    <img :src="`/${item.product?.product_image?.url}`" alt="">
                                    <span>
                                        {{ item.product.title }}
                                    </span>
                                </td>
                                <td>
                                    <div class="price">
                                        {{ get_price(item.product).new_price }}৳
                                    </div>
                                </td>
                                <td>
                                    <div class="action">
                                        <Link :href="`/product-details/${item.product.slug}`"
                                            class="btn btn-primary text-light">
                                        <i class="fa fa-shopping-cart"></i>
                                        Buy
                                        </Link>
                                    </div>
                                </td>
                                <td>
                                    <div class="action">
                                        <a @click="remove_compare_list_item(item.id)" class="btn btn-danger text-light">
                                            <i class="fa fa-trash"></i>
                                            Remove
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </template>
                    <template v-else>
                        <h2 class="td-color text-center">No item found in compare list</h2>
                    </template>

                </div>

            </div>
        </div>
    </ProfileLayout>
</template>

<script>
import { mapActions, mapState } from "pinia";
import { common_store } from "../../../Store/common_store";
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
                title: 'compare list',
                url: '/profile/compare-list',
                active: true,
            },
        ]
    }),
    created: async function () {
        await this.get_all_compare_list_items();
    },
    methods: {
        ...mapActions(common_store, {
            get_all_compare_list_items: "get_all_compare_list_items",
            remove_compare_list_item: "remove_compare_list_item",
            get_price: "get_price",
        }),
    },

    computed: {
        ...mapState(common_store, {
            all_compare_list_data: "all_compare_list_data",
        }),
    },
};
</script>

<style></style>
