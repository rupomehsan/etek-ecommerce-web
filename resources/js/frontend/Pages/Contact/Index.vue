<template>
    <Layout>
        <div class="breadcrumb-main ">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="breadcrumb-contain">
                            <div>
                                <h2>Contact Us</h2>
                                <ul>
                                    <li><a href="/">home</a></li>
                                    <li><i class="fa fa-angle-double-right"></i></li>
                                    <li><a href="javascript:void(0)">contact</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <section class="contact-page section-big-py-space b-g-light">
            <div class="custom-container">
                <div class="row section-big-pb-space">
                    <div class="col-xl-6 offset-xl-3">
                        <h3 class="text-center mb-3">Get in touch</h3>
                        <form class="theme-form">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">First Name</label>
                                        <input type="text" class="form-control" id="name" placeholder="Enter Your name"
                                            required="" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Last Name</label>
                                        <input type="text" class="form-control" id="last-name" placeholder="Last Name"
                                            required="" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="review">Phone number</label>
                                        <input type="text" class="form-control" id="review"
                                            placeholder="Enter your number" required="" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="text" class="form-control" placeholder="Email" required="" />
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div>
                                        <label>Write Your Message</label>
                                        <textarea class="form-control" placeholder="Write Your Message"
                                            rows="2"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <button class="btn btn-normal" type="submit">Send Your Message</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 map">
                        <div class="theme-card">
                            <div v-html="`${get_setting_value('map_link')}`"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </Layout>
</template>

<script>
import Layout from "../../Shared/Layout.vue";
import { common_store } from "../../Store/common_store";
import { mapActions, mapState } from "pinia";
export default {
    components: { Layout },
    methods: {
        ...mapActions(common_store, {
            get_setting_value: "get_setting_value",
        }),
    },
    computed: {
    },
};
</script>

<style></style>
