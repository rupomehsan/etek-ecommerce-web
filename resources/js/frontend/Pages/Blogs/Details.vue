<template>
    <Layout>
        <div class="breadcrumb-main ">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="breadcrumb-contain">
                            <div>
                                <h2>Blog Details</h2>
                                <ul>
                                    <li>
                                        <Link href="/">home</Link>
                                    </li>
                                    <li><i class="fa fa-angle-double-right"></i></li>
                                    <li>
                                        <Link href="/blogs">blogs</Link>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <section class="blog-detail-page section-big-py-space ratio2_3">
            <div class="container">
                <div class="row section-big-pb-space">
                    <div class="col-sm-12 blog-detail">
                        <div class="creative-card">
                            <img :src="`${single_blog_data.thumbnail_image}`" class="img-fluid w-100 " alt="blog">
                            <h3>{{ single_blog_data.title }}</h3>
                            <ul class="post-social">
                                <li>{{ new Date(single_blog_data.created_at).toDateString() }}</li>
                                <li>Posted By : Admin Admin</li>
                                <!-- <li><i class="fa fa-heart"></i> 5 Hits</li>
                                <li><i class="fa fa-comments"></i> 10 Comment</li> -->
                            </ul>
                           <div v-html="single_blog_data.description"></div>
                        </div>
                    </div>
                </div>

                <!-- <div class="row section-big-pb-space">
                    <div class="col-sm-12 ">
                        <div class="creative-card">
                            <ul class="comment-section">
                                <li>
                                    <div class="media"><img src="/frontend/assets/images/avtar/1.jpg"
                                            alt="Generic placeholder image">
                                        <div class="media-body">
                                            <h6>Mark Jecno <span>( 12 Jannuary 2018 at 1:30AM )</span></h6>
                                            <p>Donec rhoncus massa quis nibh imperdiet dictum. Vestibulum id est sit
                                                amet felis fringilla bibendum at at leo. Proin molestie ac nisi eu
                                                laoreet. Integer faucibus enim nec ullamcorper tempor. Aenean nec felis
                                                dui.</p>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="media"><img src="/frontend/assets/images/avtar/2.jpg"
                                            alt="Generic placeholder image">
                                        <div class="media-body">
                                            <h6>Mark Jecno <span>( 12 Jannuary 2018 at 1:30AM )</span></h6>
                                            <p>Donec rhoncus massa quis nibh imperdiet dictum. Vestibulum id est sit
                                                amet felis fringilla bibendum at at leo. Proin molestie ac nisi eu
                                                laoreet. Integer faucibus enim nec ullamcorper tempor. Aenean nec felis
                                                dui.</p>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="media"><img src="/frontend/assets/images/avtar/3.jpg"
                                            alt="Generic placeholder image">
                                        <div class="media-body">
                                            <h6>Mark Jecno <span>( 12 Jannuary 2018 at 1:30AM )</span></h6>
                                            <p>Donec rhoncus massa quis nibh imperdiet dictum. Vestibulum id est sit
                                                amet felis fringilla bibendum at at leo. Proin molestie ac nisi eu
                                                laoreet. Integer faucibus enim nec ullamcorper tempor. Aenean nec felis
                                                dui.</p>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class=" row blog-contact">
                    <div class="col-sm-12  ">
                        <div class="creative-card">
                            <h2>Leave Your Comment</h2>
                            <form class="theme-form">
                                <div class="row g-3">
                                    <div class="col-md-12">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" id="name" placeholder="Enter Your name"
                                            required="">
                                    </div>
                                    <div class="col-md-12">
                                        <label for="email">Email</label>
                                        <input type="text" class="form-control" id="email" placeholder="Email"
                                            required="">
                                    </div>
                                    <div class="col-md-12">
                                        <label for="exampleFormControlTextarea1">Comment</label>
                                        <textarea class="form-control" placeholder="Write Your Comment"
                                            id="exampleFormControlTextarea1" rows="6"></textarea>
                                    </div>
                                    <div class="col-md-12">
                                        <button class="btn btn-normal" type="submit">Post Comment</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div> -->
            </div>
        </section>
    </Layout>
</template>

<script>
import { mapActions, mapState } from 'pinia';
import Layout from "../../Shared/Layout.vue";
import { blog_store } from "./Store/blog_store"
export default {
    props: {
        slug: String
    },
    components: { Layout },
    created: async function () {
        await this.get_single_blog(this.slug)
    },
    methods: {
        ...mapActions(blog_store, {
            get_single_blog: 'get_single_blog'
        }),

    },
    computed: {
        ...mapState(blog_store, {
            single_blog_data: 'single_blog_data'
        })
    }
};
</script>
