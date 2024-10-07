<template>
    <!-- footer start -->
    <footer>
        <div class="footer1">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="footer-main">
                            <div class="footer-box">
                                <div class="footer-contant">
                                    <div class="footer-logo">
                                        <Link href="/">
                                        <img :src="`/${get_setting_value('footer_logo')}`" class="img-fluid" alt="logo">
                                        </Link>
                                    </div>
                                    <div>
                                        <h2 class="mb-3" style="font-size: 20px;">
                                            {{ get_setting_value('title') }}
                                        </h2>
                                        <p style="text-align: justify;">
                                            {{ get_setting_value('description') }}
                                        </P>
                                    </div>
                                    <ul class="sosiyal">
                                        <li><a :href="get_setting_value('facebook')"><i class="fa fa-facebook"></i></a>
                                        </li>
                                        <li><a :href="get_setting_value('google')"><i class="fa fa-google-plus"></i></a>
                                        </li>
                                        <li><a :href="get_setting_value('twitter')"><i class="fa fa-twitter"></i></a>
                                        </li>
                                        <li><a :href="get_setting_value('instagram')"><i
                                                    class="fa fa-instagram"></i></a>
                                        </li>
                                        <li><a :href="get_setting_value('telegram')"><i class="fa fa-telegram"></i></a>
                                        </li>
                                        <li><a :href="get_setting_value('youtube')"><i class="fa fa-youtube"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="footer-box">
                                <div class="footer-title">
                                    <h5>my account</h5>
                                </div>
                                <div class="footer-contant">
                                    <ul>
                                        <li>
                                            <Link href="/about">about us</Link>
                                        </li>
                                        <li>
                                            <Link href="/contact">contact us</Link>
                                        </li>
                                        <li>
                                            <Link href="/terms-conditions">terms &amp; conditions</Link>
                                        </li>
                                        <li>
                                            <Link href="/returns-exchanges">returns &amp; exchanges</Link>
                                        </li>
                                        <li>
                                            <Link href="/shipping-delivery">shipping &amp; delivery</Link>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="footer-box">
                                <div class="footer-title">
                                    <h5>contact us</h5>
                                </div>
                                <div class="footer-contant">
                                    <ul class="contact-list">
                                        <li>
                                            <i class="fa fa-map-marker"></i>
                                            {{ get_setting_value('address') }}
                                        </li>
                                        <li>
                                            <i class="fa fa-phone"></i>
                                            call us:
                                            <span>
                                                {{ get_setting_value('phone_numbers') }}
                                            </span>
                                        </li>
                                        <li><i class="fa fa-envelope-o"></i>email us: {{ get_setting_value('emails') }}
                                        </li>
                                        <li><i class="fa fa-fax"></i>fax <span>{{ get_setting_value('fax') }}</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="footer-box">
                                <div class="footer-title">
                                    <h5>newsletter</h5>
                                </div>
                                <div class="footer-contant">
                                    <form action="" @submit.prevent="submitHandler">
                                        <div class="newsletter-second">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="ti-user"></i></span>
                                                    <input type="text" name="name" id="name" class="form-control"
                                                        placeholder="enter full name" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="ti-email"></i>
                                                    </span>
                                                    <input type="email" name="email" id="email" class="form-control"
                                                        placeholder="enter email address" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-solid btn-sm">submit now</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="subfooter footer-border">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="footer-left">
                            <p>{{ get_setting_value('copy_right') }}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="footer-right">
                            <ul class="payment">
                                <li>
                                    <a href="javascript:void(0)">
                                        <img src="/cache/frontend/assets/images/1(7).png" class="img-fluid" alt="pay">
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">
                                        <img src="/cache/frontend/assets/images/2(7).png" class="img-fluid" alt="pay">
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">
                                        <img src="/cache/frontend/assets/images/3(7).png" class="img-fluid" alt="pay">
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">
                                        <img src="/cache/frontend/assets/images/4(4).png" class="img-fluid" alt="pay">
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">
                                        <img src="/cache/frontend/assets/images/5(5).png" class="img-fluid" alt="pay">
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- footer end -->

    <FooterNav />

    <all-categories />

    <side-card></side-card>

    <login-modal></login-modal>

    <FloatingCart />

</template>

<script>
import { mapActions, mapState } from "pinia";
import { common_store } from "../Store/common_store";
import { use_home_page_store } from "../Pages/Home/Store/home_page_store"

import AllCategories from '../Pages/Home/Components/Category/AllCategories.vue';
import LoginModal from '../Pages/Auth/Components/LoginModal.vue';
import SideCard from './Components/SideCard.vue';
import FooterNav from "./Components/FooterNav.vue";
import FloatingCart from "./Components/FloatingCart.vue";

export default {
    components: {
        AllCategories, LoginModal,
        SideCard, FooterNav,
        FloatingCart,
    },
    created: async function () {
        // Uncomment the following line if you want to call the method on creation
    },

    methods: {
        ...mapActions(common_store, {
            get_all_cart_data: "get_all_cart_data",
            remove_cart_item: "remove_cart_item",
            cart_quantity_update: "cart_quantity_update",
            get_setting_value: "get_setting_value",
        }),
        ...mapActions(use_home_page_store, {
            store_news_letter_subscriber: 'store_news_letter_subscriber'
        }),
        submitHandler() {
            let formData = event.target
            this.store_news_letter_subscriber(formData)
            event.target.reset()
        },

        load_image: window.load_image,
    },

    computed: {
        ...mapState(common_store, {
            all_cart_data: "all_cart_data",
            total_cart_price: "total_cart_price",
        }),
    },


};
</script>


<style></style>
