<template>
    <div>
        <form class="theme-form" @submit.prevent="submitReview">
            <div class="row">
                <div class="col-md-12">
                    <div class="media">
                        <label>Rating</label>
                        <div class="media-body ms-3">
                            <div class="rating">
                                <i class="fa fa-star" v-for="n in 5" :key="n"
                                    :class="{ active: n <= rating, inactive: n > rating }" @click="setRating(n)">
                                </i>
                                <div id="rating"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <label>Write Your Review</label>
                    <textarea class="form-control" id="review" placeholder="Write Your Testimonial Here"
                        v-model="review" rows="6"></textarea>
                </div>

                <div class="col-md-12 multifile">
                    <label>Upload files</label>
                    <input type="file" ref="fileInput" class="form-control " multiple @change="handleFileUpload">
                    <div class="file-info my-2">
                        {{ fileInfo }}
                    </div>
                    <div class="my-2 d-flex gap-3 flex-wrap">
                        <div v-for="(image, index) in imagePreviews" :key="index" class="position-relative">
                            <img class="img-thumbnail" :src="image" width="100" height="100" alt="">
                            <i class="fa fa-remove position-absolute c-pointer text-danger" aria-hidden="true"
                                @click="removeImage(index)"></i>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <button class="btn btn-normal" type="submit">Submit Your Review</button>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
import { useProductDetailsStore } from '../Store/product_details_store.js';
import { computed } from 'vue';

export default {

    props: {
        slug: String,
    },

    setup(props) {

        const reviewStore = useProductDetailsStore();

        const is_auth = localStorage.getItem("token") ? true : false;
        const rating = computed(() => reviewStore.rating);
        const imageFiles = computed(() => reviewStore.imageFiles);
        const imagePreviews = computed(() => reviewStore.imagePreviews);

        // reviewStore.slug = props.slug;

        const review = computed({
            get: () => reviewStore.review,
            set: (value) => reviewStore.setReview(value)
        });
        const setRating = (rating) => {
            reviewStore.setRating(rating);
        };

        const handleFileUpload = (event) => {
            const files = event.target.files;
            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                reviewStore.addImageFile(file);
                const reader = new FileReader();
                reader.onload = (e) => {
                    reviewStore.imagePreviews.push(e.target.result);
                };
                reader.readAsDataURL(file);
            }
            // Clear the file input after processing the files
            event.target.value = null;
        };

        const removeImage = (index) => {
            reviewStore.imagePreviews.splice(index, 1);
            reviewStore.removeImageFile(index);
            // Reset the file input value if all images are removed
            if (reviewStore.imageFiles.length === 0) {
                document.querySelector('input[type="file"]').value = null;
            }
        };

        const fileInfo = computed(() => {
            return reviewStore.imageFiles.length === 0
                ? 'No file chosen'
                : `${reviewStore.imageFiles.length} file(s) selected`;
        });

        const submitReview = () => {

            if (!is_auth) {
                document.getElementById("myAccount").classList.add('open-side');
            }
            reviewStore.submitReview();
        };

        return {
            rating,
            review,
            imagePreviews,
            imageFiles,
            setRating,
            handleFileUpload,
            removeImage,
            fileInfo,
            submitReview,
            is_auth
        };
    }
};
</script>

<style>
.fa-star {
    cursor: pointer;
    color: #d3d3d3;
}

.fa-star.active {
    color: #ffc107;
    font-size: 25px;
}

.fa-star.inactive {
    color: #8e8e8e;
    font-size: 25px;
}


.c-pointer {
    cursor: pointer;
}

.multifile {
    position: relative;
}

.file-info.my-2 {
    position: absolute;
    z-index: 3;
    background: white;
    width: 200px;
    height: 30px;
    top: 40px;
    left: 140px;
}
</style>
