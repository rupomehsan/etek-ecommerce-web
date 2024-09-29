<template>
    <section class="section-big-py-space  ratio_asos b-g-light">
        <div class="custom-container">
            <div class="row">
                <div class="col-12 product-related">
                    <h2>Top products</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="custom-container">
                        <div class="product_list">
                            <div v-for="i in products" :key="i.name">
                                <ProductItem :product="i" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import ProductItem from "../../../Components/ProductItem.vue";
export default {
   components: { ProductItem },
    props: ["products"],

}
</script>

<style></style>
