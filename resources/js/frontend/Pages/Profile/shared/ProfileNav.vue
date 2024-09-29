<template>
    <div>
        <div class="account-sidebar"><a class="popup-btn">my account</a></div>
        <div class="dashboard-left">
            <div class="collection-mobile-back">
                <span class="filter-back"><i class="fa fa-angle-left" aria-hidden="true"></i>
                    back</span>
            </div>
            <div class="block-content">

                <ul>
                    <li class="profile_nav_top">
                        <div class="profile_image">
                            <img v-if="previewUrl" :src="check_image_url(previewUrl)" alt="user-profile-pic">
                            <img v-else-if="user.photo" :src="check_image_url(user.photo)" alt="user-profile-pic">
                            <img v-else :src="check_image_url('avatar.png')" alt="user-profile-pic">
                            <div class="upload_icon" @click.prevent="triggerFileInput">
                                <a href="javascript:void(0)">
                                    <i class="fa fa-picture-o" aria-hidden="true"></i>
                                </a>
                                <p>Change profile picture</p>
                            </div>
                            <input class="d-none" type="file" ref="fileInput" accept="image/*" @change="previewImage">

                        </div>

                        <div>
                            <h4>
                                {{ user.name }}
                            </h4>
                        </div>
                    </li>
                    <li :class="{ 'active': $page.url === '/profile' }">
                        <Link href="/profile">
                        At a glance
                        </Link>
                    </li>
                    <li :class="{ 'active': $page.url === '/profile/orders' }">
                        <Link href="/profile/orders">
                        Orders
                        </Link>
                    </li>
                    <li :class="{ 'active': $page.url === '/profile/wish-list' }">
                        <Link href="/profile/wish-list">
                        Wish List
                        </Link>
                    </li>
                    <li :class="{ 'active': $page.url === '/profile/compare-list' }">
                        <Link href="/profile/compare-list">
                        Compare List
                        </Link>
                    </li>
                    <li :class="{ 'active': $page.url === '/profile/account' }">
                        <Link href="/profile/account">
                        Edit Account
                        </Link>
                    </li>
                    <li :class="{ 'active': $page.url === '/profile/address' }">
                        <Link href="/profile/address">
                        Edit Address
                        </Link>
                    </li>
                    <!-- <li :class="{ 'active': $page.url === '/profile/password' }">
                        <Link href="/profile/password">
                        Password
                        </Link>
                    </li> -->

                    <li class="last"><a @click="log_out()" href="javascript:void(0)">Log Out</a></li>
                </ul>
            </div>
        </div>
    </div>
</template>
<script>
import { mapActions } from "pinia";
import { auth_store } from "../../../Store/auth_store";
import { watch } from 'vue';
export default {
    props: {
        auth: Object,
        userInfo: {
            type: Object,
            required: true,
        },
    },
    data: () => ({
        user: {},
        previewUrl: null,
    }),
    created() {
        watch(() => this.userInfo, (newUserInfo) => {
            this.user = { ...newUserInfo };
            this.previewUrl = this.user?.photo
        }
        );

    },
    methods: {
        ...mapActions(auth_store, {
            log_out: "log_out",
            // update_profile_picture: "update_profile_picture",
        }),

        check_image_url: function (url) {
            try {
                new URL(url);
                return url;
            } catch (e) {
                return "/" + url;
            }
        },
        triggerFileInput() {
            this.$refs.fileInput.click();
        },
        previewImage(event) {
            const file = event.target.files[0];
            if (file) {
                this.previewUrl = URL.createObjectURL(file);
                this.update_profile_picture(file);
            }
        },
        async update_profile_picture(file) {
            try {
                let formData = new FormData();
                formData.append("profile_picture", file);

                let response = await window.privateAxios("/customers/update-profile-picture", 'post', formData);

                if (response.status === 'success') {
                    window.s_alert(response.message);
                }
            } catch (error) {
                console.log('Error uploading image:', error);

            }
        }
    }
}
</script>
<style lang="">

</style>
