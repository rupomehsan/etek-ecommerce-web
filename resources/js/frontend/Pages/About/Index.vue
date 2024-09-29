<template>
    <Layout>
        <div class="breadcrumb-main ">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="breadcrumb-contain">
                            <div>
                                <h2>About Us</h2>
                                <ul>
                                    <li>
                                        <Link href="/">home</Link>
                                    </li>
                                    <li><i class="fa fa-angle-double-right"></i></li>
                                    <li><a href="javascript:void(0)">about</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <section class="about-page section-big-py-space b-g-light">
            <div class="container">
                <h1 class="content_title pb-2">ETECH Ltd</h1>
                <div v-html="`${get_setting_value('about_us')}`"></div>
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
        })
    },
    computed: {
        ...mapState(common_store, {
        }),
    },
};
</script>

<style></style>
