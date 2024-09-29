<template>
    <Layout>
        <div class="breadcrumb-main ">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="breadcrumb-contain">
                            <div>
                                <h2>Blogs</h2>
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
        <section class="section-big-py-space blog-page ratio2_3">
            <div class="custom-container">
                <div class="row">
                    <div class="col-xl-9 col-lg-8 col-md-7">
                        <div class="row blog-media" v-for="blog in blog_data.data" :key="blog.id">
                            <div class="col-xl-6">
                                <div class="blog-left">
                                    <Link :href="`/blog-details/${blog.slug}`"><img :src="blog.thumbnail_image"
                                        class="img-fluid  " alt=""></Link>
                                    <div class="date-label">
                                        {{ new Date(blog.created_at).toDateString() }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="blog-right">
                                    <div>
                                        <Link :href="`/blog-details/${blog.slug}`">
                                        <h4>{{ blog.title }}</h4>
                                        </Link>
                                        <ul class="post-social">
                                            <li>Posted By : Admin Admin</li>
                                            <!-- <li><i class="fa fa-heart"></i> 5 Hits</li>
                                            <li><i class="fa fa-comments"></i> 10 Comment</li> -->
                                        </ul>
                                        <p>{{ blog.description }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="product-pagination">
                            <div class="theme-paggination-block">
                                <div class="row">
                                    <div class="col-xl-6 col-md-6 col-sm-12">
                                        <nav aria-label="Page navigation">
                                            <ul class="pagination">
                                                <li class="page-item" :class="{ active: link.active }"
                                                    v-for="(link, index) in blog_data.links" :key="index">
                                                    <a :href="link.url" @click.prevent="get_all_blogs(link.url)"
                                                        class="page-link text_no_wrap">
                                                        <span v-html="link.label"></span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </nav>
                                    </div>
                                    <div class="col-xl-6 col-md-6 col-sm-12">
                                        <div class="product-search-count-bottom">
                                            <h5>
                                                Showing Products {{ blog_data.from }} -
                                                {{ blog_data.to }} of {{ blog_data.total }}
                                                Result
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-5 order-sec">
                        <div class="blog-sidebar">
                            <!-- <div class="theme-card">
                                <h4>Recent Blog</h4>
                                <ul class="recent-blog">
                                    <li>
                                        <div class="media"> <img class="img-fluid "
                                                src="/frontend/assets/images/blog/1.jpg"
                                                alt="Generic placeholder image">
                                            <div class="media-body align-self-center">
                                                <h6>25 Dec 2018</h6>
                                                <p>0 hits</p>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div> -->
                            <div class="theme-card">
                                <h4>Popular Blog</h4>
                                <ul class="popular-blog">
                                    <li v-for="blog in blog_data.data" :key="blog.id">
                                        <Link :href="`/blog-details/${blog.slug}`">
                                        <div class="media">
                                            <div class="blog-date"> <span>{{ new Date(blog.created_at).toDateString()
                                                    }}</span>
                                            </div>
                                            <div class="media-body align-self-center">
                                                <h6>{{ blog.title }}</h6>
                                                <!-- <p>0 hits</p> -->
                                            </div>
                                        </div>
                                        </Link>
                                        <!-- <p>it look like readable English. Many desktop publishing text.</p> -->
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </Layout>
</template>

<script>
import { mapActions, mapState } from 'pinia';
import Layout from "../../Shared/Layout.vue";
import { blog_store } from "./Store/blog_store"
export default {

    components: { Layout },
    created: async function () {
        await this.get_all_blogs()
    },
    methods: {
        ...mapActions(blog_store, {
            get_all_blogs: 'get_all_blogs',
            load_blogs: 'load_blogs'
        }),

    },
    computed: {
        ...mapState(blog_store, {
            blog_data: 'blog_data'
        })
    }
};
</script>

<style></style>
