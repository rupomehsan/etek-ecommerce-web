import axios from "axios";
import { defineStore } from "pinia";

export const useProductDetailsStore = defineStore("useProductDetailsStore", {
    state: () => ({
        slug: '',
        product_initial_data: {},
        related_generic_products_data: {},
        product_details: {},
        top_products: [],
        related_porducts: [],

        product_question_and_answers: [],
        is_question_form_show: false,

        rating: '',
        review: '',
        imageFiles: [],
        imagePreviews: [],

        fields: [
            "id",
            "title",
            "short_description",
            "customer_sales_price",
            "discount_type",
            "discount_amount",
            "product_brand_id",
            "sku",
            "type",
            "slug",
            'is_available',
            'retailer_sales_price',
            'b2b_discount_price',
            'b2c_discount_price',
        ]


    }),
    getters: {},
    actions: {
        /**
        ## Product information
        ## start
        **/
        get_single_product_initial_data: async function (slug) {
            const fieldsQuery = this.fields.map((field, index) => `fields[${index}]=${field}`).join('&');
            let response = await axios.get(`/get-initial-product-details/${slug}?${fieldsQuery}`)
            if (response.data.status === "success") {
                this.product_initial_data = response.data.data
            }
            // console.log(this.product_initial_data);
        },
        get_related_generic_products: async function () {
            // const fieldsQuery = this.fields.map((field, index) => `fields[${index}]=${field}`).join('&');
            let response = await axios.get(`/get-related-generic-products/${this.slug}`)
            if (response.data.status === "success") {
                this.related_generic_products_data = response.data.data
            }
            // console.log(this.product_initial_data);
        },
        get_single_product_details: async function (slug) {
            let response = await axios.get('/get-product-details/' + slug)
            if (response.data.status === "success") {
                this.product_details = response.data.data
            }
            // console.log(this.product_details);
        },

        get_top_products: async function () {
            if (this.top_products.length > 0) {
                return
            }
            const fieldsQuery = this.fields.map((field, index) => `fields[${index}]=${field}`).join('&');
            let res = await axios.get("/get-all-featured-products?get_all=1&limit=24&" + fieldsQuery);
            this.top_products = res.data?.data;

        },

        /**
        ## Product information
        ## end
        **/

        /**
       ## questions section
       ## start
       */
        toggle_question_form: function () {
            this.is_question_form_show = !this.is_question_form_show
        },
        submit_question: async function (data) {
            let formData = new FormData(data);
            formData.append('slug', this.slug);
            let response = await window.privateAxios('/customer-ecommerce-question', 'post', formData);
            if (response.status === "success") {
                window.s_alert(response.message);
                this.toggle_question_form()
                this.get_all_question_and_answers();
            }
        },

        get_all_question_and_answers: async function (slug) {
            let is_auth = localStorage.getItem("token") ? true : false;
            if (is_auth) {
                let response = await axios.get('/get-customer-ecommerce-question-and-answers?slug=' + slug);
                if (response.data.status === "success") {
                    this.product_question_and_answers = response.data.data
                }
            }
        },
        /**
             ## Review section
             ## start
             */
        submitReview: async function () {
            const formData = new FormData();
            formData.append('rating', this.rating);
            formData.append('review', this.review);
            formData.append('slug', this.slug);
            this.imageFiles.forEach((file, index) => {
                formData.append(`review_images[${index}]`, file);
            });
            try {
                const response = await window.privateAxios('/submit-product-review', 'post', formData);

                if (response.status === "success") {
                    window.s_alert(response.message);
                    this.rating = 0;
                    this.review = '';
                    this.imageFiles = [];
                    this.imagePreviews = [];
                }


            } catch (error) {
                console.error('There was an error!', error);
            }
        },
        setRating(rating) {
            console.log(rating);
            this.rating = rating;
        },
        addImageFile(file) {
            this.imageFiles.push(file);
        },
        addImagePreview(preview) {
            this.imagePreviews.push(preview);
        },
        removeImageFile(index) {
            this.imageFiles.splice(index, 1);
        },
        setReview(review) {
            this.review = review;
        },
        set_slug(slug) {
            this.slug = slug
        }
        /**
        ## Review section
        ## end
        */

    }
});
