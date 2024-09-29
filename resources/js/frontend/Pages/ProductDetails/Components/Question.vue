<template>
    <section class="ask-question q-n-r-section bg-white m-tb-15" id="ask-question">
        <div class="card mt-1">
            <div class="card-header">

                <div class=" d-flex gap-3 justify-content-between">
                    <div class="title-n-action">
                        <h2 class="ask_question_heading">Questions & Answare Section</h2>
                    </div>
                    <div class="q-action">
                        <a class="btn btn-info" @click="toggle_question_form">
                            Ask Question</a>
                    </div>
                </div>

                <div v-if="is_question_form_show">
                    <form @submit.prevent="submitQuestionForm($event)">
                        <div class="col-md-12">

                            <textarea class="form-control my-2" name="question" id="question"
                                placeholder="Write Your Question Here" rows="6"></textarea>
                        </div>
                        <div class="col-md-12 my-2 d-flex justify-content-center">
                            <button class="btn btn-normal " type="submit">Submit Your Review</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <template v-if="product_question_and_answers.data?.length">
            <template v-for="(item, index) in product_question_and_answers.data" :key="item.id">
                <div class="card mt-4">
                    <div class="card-header d-flex gap-3  justify-content-between">
                        <div class="title-n-action">
                            <h2 class="ask_question_heading">Questions ({{ index + 1 }})</h2>
                            <p class="ask_question_pg p-0 mt-1">
                                {{ item.question }}
                            </p>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="questions">
                            <div class="question-wrap">
                                <p class="author p-0"><span class="name">{{ item.user?.name }} </span> on
                                    {{ new Date(item.created_at).toDateString() }}
                                </p>
                                <h3 class="question text-sm">
                                    <span class="hint">Q:</span>
                                    <span>
                                        {{ item.question }}
                                    </span>
                                </h3>
                                <p class="answer">
                                    <span class="hint">A:</span>
                                    <span>
                                        {{ item.answare ?? "No Answer" }}
                                    </span>
                                </p>
                                <p class="author" v-if="item.answare">
                                    <span class=""> By </span>
                                    <span class="px-2 fw-bold">Etek BD Support </span>
                                    <span class="">{{ new Date(item.updated_at).toDateString() }}</span>
                                </p>
                            </div>
                            <div class="text-right"></div>
                        </div>
                    </div>
                </div>

            </template>
        </template>
        <!-- <template v-else>
                <div class="card-body">
                    <h3 class="text-center">No Question Found</h3>
                </div>
            </template> -->
    </section>
</template>

<script>
import { mapActions, mapState } from 'pinia';
import { useProductDetailsStore } from '../Store/product_details_store.js';
export default {
    props: {
        slug: String,
    },
    data: () => ({
        is_auth: false,
    }),



    created: async function () {
        this.is_auth = localStorage.getItem("token") ? true : false;

    },


    methods: {
        ...mapActions(useProductDetailsStore, {
            submit_question: "submit_question",
            get_all_question_and_answers: "get_all_question_and_answers",
            toggle_question_form: "toggle_question_form",
        }),

        submitQuestionForm: async function (event) {
            if(!this.is_auth){
                return alert('Please Login to ask your question.');
            }
            this.submit_question(event.target);
        },

    },


    computed: {
        ...mapState(useProductDetailsStore, {
            product_question_and_answers: 'product_question_and_answers',
            is_question_form_show: 'is_question_form_show',
        }),
    },
}
</script>

<style></style>
