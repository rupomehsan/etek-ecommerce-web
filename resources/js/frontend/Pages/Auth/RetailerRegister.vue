<template>
    <Layout>
        <div class="breadcrumb-main py-3">
            <div class="custom-container">
                <BreadCumb :bread_cumb="bread_cumb" />
            </div>
        </div>

        <section class="login-page section-big-py-space b-g-light">
            <div class="custom-container">
                <div class="row" v-if="is_register">
                    <div class="col-xl-4 col-lg-6 col-md-8 offset-xl-4 offset-lg-3 offset-md-2">
                        <div class="theme-card">
                            <h3 class="text-center">Retailer Register</h3>
                            <form class="theme-form" @submit.prevent="registerFormHandler($event)" method="post">
                                <div class="form-group">
                                    <label>Enter your Full name</label>
                                    <input type="text" name="name" v-model="name" id="name" class="form-control"
                                        placeholder="Enter your full name" />
                                </div>
                                <div class="form-group">
                                    <label>Enter your Phone</label>
                                    <input type="number" name="phone_number" id="phone_number" class="form-control"
                                        placeholder="Enter your phone number" />
                                </div>
                                <div class="form-group">
                                    <label>Enter your Shop name</label>
                                    <input type="text" v-model="shop_name" name="shop_name" id="shop_name"
                                        class="form-control" placeholder="Enter your shop name" />
                                </div>
                                <div class="form-group">
                                    <label>Enter license Numaber</label>
                                    <input type="number" v-model="license_number" name="license_number"
                                        id="license_number" class="form-control"
                                        placeholder="Enter your license number" />
                                </div>

                                <button class="btn btn-normal">Register</button>
                                <!-- <a class="float-end txt-default mt-2" href="#">
                                    Forgot your password?
                                </a> -->
                            </form>



                        </div>
                    </div>
                </div>

                <div class="row" v-if="is_otp_verify">
                    <div class="col-xl-4 col-lg-6 col-md-8 offset-xl-4 offset-lg-3 offset-md-2">
                        <div class="theme-card">
                            <h3 class="text-center">Verify otp</h3>
                            <form class="theme-form" @submit.prevent="OtpVerifyFormHandler($event)" method="post">
                                <div class="form-group">
                                    <label>Enter your otp</label>
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
                title: 'register',
                url: '/register',
                active: true,
            },
        ],
        type: "password",
        is_register: true,
        is_otp_verify: false,
        phone_number: "",
        name: "",
        shop_name: "",
        license_number: "",

    }),
    created: async function () {
        let token = localStorage.getItem("token");
        if (token) {
            window.location.href = "/profile";
        }
    },
    methods: {
        ...mapActions(auth_store, {
            check_is_auth: "check_is_auth",
            user_login: "user_login",
        }),
        registerFormHandler: async function (event) {
            let formData = new FormData(event.target);
            let response = await axios.post('/retailer-register', formData)
            if (response.data?.status === "success") {
                window.s_alert(response.data?.message);
                this.is_register = false;
                this.is_otp_verify = true;
                this.phone_number = response.data?.data?.phone_number;
                console.log(this.phone_number);

            }
        },
        OtpVerifyFormHandler: async function (event) {
            let formData = new FormData(event.target);
            formData.append("phone_number", this.phone_number);
            formData.append("name", this.name);
            let response = await axios.post('/verify-user-otp?type=retailer', formData)
            if (response.data?.status === "success") {
                localStorage.setItem("token", response.data?.data?.access_token);
                window.s_alert(response.data?.message);
                setTimeout(() => {
                    window.s_alert("You are successfully login ");
                    window.location.href = "/profile";
                }, 1000)

            }
        },
        showPassword: function () {
            if (this.type === "password") {
                this.type = "text";
            } else {
                this.type = "password";
            }
        }
    },
    computed: {
        ...mapState(auth_store, {
            is_auth: "is_auth",
        }),
    },
};
</script>

<style>
.password-icon {
    position: relative;
}

.password-icon i {
    position: absolute;
    right: 10px;
    top: 20px;
    cursor: pointer;
}
</style>
