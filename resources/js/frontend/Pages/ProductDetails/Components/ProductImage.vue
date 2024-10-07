<template>
    <template v-if="product.product_image">
        <a :href="load_image(`${imageUrl}`)" data-lightbox="prouct-set" :data-title="`Product image`">
            <img :src="load_image(imageUrl)" :alt="product.title" class="img-fluid image_zoom_cls-0" />
        </a>
        <ul v-if="product.product_images?.length" class="mt-3">
            <li v-for="(image, index) in product.product_images" :key="image.id" class="m-2">
                <a :href="load_image(`${image.url}`)" data-lightbox="prouct-set"
                    :data-title="`Additional image ${index + 1}`">
                    <img height="100" width="100" class="border p-1 mx-1  c-pointer"
                        @click="imageUrl = load_image(image.url)" :src="load_image(`${image.url}`)"
                        :alt="product.title" />
                </a>
            </li>
        </ul>
    </template>
    <template v-else>
        <img src="/dummy.png" :alt="product.title" class="img-fluid image_zoom_cls-0" />
    </template>
</template>

<script>
export default {
    props: {
        product: Object
    },
    data: () => ({
        imageUrl: '',
    }),
    created() {
        this.imageUrl = this.load_image(this.product.product_images?.length ? this.product.product_images[0].url : '');
    },
    watch: {
        product() {
            this.imageUrl = this.load_image(this.product.product_images?.length ? this.product.product_images[0].url : '');
        }
    },
    methods: {
    }
}
</script>

<style></style>
