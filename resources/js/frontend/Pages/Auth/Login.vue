<template>
    <Layout>
        <div class="breadcrumb-main py-3">
            <div class="custom-container">
                <BreadCumb :bread_cumb="bread_cumb" />
            </div>
        </div>

        <section class="login-page section-big-py-space b-g-light">
            <div class="custom-container">
                <div class="row" v-if="is_login">
                    <div class="col-xl-4 col-lg-6 col-md-8 offset-xl-4 offset-lg-3 offset-md-2">
                        <div class="theme-card">
                            <h3 class="text-center">Login</h3>
                            <form class="theme-form" @submit.prevent="loginFormHandler($event)" method="post">
                                <label>Enter your phone number or email</label>
                                <input type="text" name="phone_number" id="phone_number" class="form-control"
                                    placeholder="phone number or email" />

                                <!-- <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" name="email" id="email" class="form-control"
                                        placeholder="Email" />
                                </div> -->
                                <!-- <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" name="password" id="password" class="form-control"
                                        placeholder="Enter your password" />
                                </div> -->

                                <button class="btn btn-normal mt-2">Login</button>
                                <!-- <a class="float-end txt-default mt-2" href="#">
                                    Forgot your password?
                                </a> -->
                            </form>
                            <p class="mt-3">Sign up for a free account at our store. Registration is quick and easy. It
                                allows you to be able to order from our shop. To start shopping click register.</p>
                            <Link href="/register" class="txt-default pt-3 d-block">Create an Account</Link>
                        </div>
                    </div>
                </div>
                <div class="row" v-if="is_otp_verify">
                    <div class="col-xl-4 col-lg-6 col-md-8 offset-xl-4 offset-lg-3 offset-md-2">
                        <div class="theme-card">
                            <h3 class="text-center">Verify otp</h3>
                            <form class="theme-form" @submit.prevent="OtpVerifyFormHandler($event)" method="post">
                                <div class="form-group">
                                    <label>
                                        Enter your otp
                                    </label>
                                    <input type="number" name="otp" id="otp" class="form-control">
                                </div>
                                <button class="btn btn-normal">Send</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </Layout>
</template>

<script>
import { mapActions, mapState } from "pinia";
import { auth_store } from "../../Store/auth_store.js";
import BreadCumb from "../../Components/BreadCumb.vue";
import Layout from "../../Shared/Layout.vue";
export default {
    components: { Layout, BreadCumb },
    data: () => ({
        bread_cumb: [
            {
                title: 'login',
                url: '/login',
                active: true,
            },
        ],

        is_login: true,
        is_otp_verify: false,
        phone_number: "",

    }),
    created: async function () {
        let token = localStorage.getItem("token");
        if (token) {
            window.location.href = "/profile";
        }

    },
    methods: {

        loginFormHandler: async function (event) {
            let formData = new FormData(event.target);
            let response = await axios.post('/login', formData)
            if (response.data?.status === "success") {
                window.s_alert(response.data?.message);
                this.is_login = false;
                this.is_otp_verify = true;
                this.phone_number = response.data?.data?.phone_number;
            }
        },

        OtpVerifyFormHandler: async function (event) {
            let formData = new FormData(event.target);
            formData.append("phone_number", this.phone_number);
            // let response = await axios.post('/verify-user-otp', formData)
            let url = location.origin + '/verify-user-otp';
            let response = await axios.post(url, formData)
            if (response.data?.status === "success") {
                localStorage.setItem("token", response.data?.data?.access_token);
                window.s_alert(response.data?.message);
                setTimeout(() => {
                    window.s_alert("You are login successfully");
                    window.location.href = "/profile";
                }, 1000)

            }
        },

    },

};
</script>

<style></style>
