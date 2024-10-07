<template>
    <ProfileLayout :bread_cumb="bread_cumb">
        <div class="dashboard">
            <div class="page-title">
                <h2>
                    Edit Acount Information
                </h2>
            </div>
            <div class="box-account box-info">

                <form action="" method="post" @submit.prevent="accountFormSubmitHandler($event)"
                    enctype="multipart/form-data" class="form-horizontal">
                    <div class="multiple-form-group">
                        <div class="form-group required">
                            <label for="name">Name </label>
                            <input type="text" required name="name" id="name" placeholder="Name" :value="user_info.name"
                                class="form-control">
                        </div>
                        <div class="form-group required">
                            <label for="user_name">User Name</label>
                            <input type="text" name="user_name" placeholder="User Name" id="user_name"
                                class="form-control" :value="user_info.user_name">
                        </div>
                    </div>
                    <div class="form-group required">
                        <label for="email">E-Mail</label>
                        <input type="email" name="email" placeholder="E-Mail" :value="user_info.email" id="email"
                            class="form-control">
                    </div>
                    <div class="form-group required">
                        <label for="phone_number">Phone Number</label>
                        <input type="tel" readonly name="phone_number" :value="user_info.phone_number" placeholder="Phone Number"
                            id="phone_number" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>

            </div>
        </div>
    </ProfileLayout>
</template>

<script>
import ProfileLayout from "../shared/ProfileLayout.vue";
import { auth_store } from "../../../Store/auth_store.js";
import { ref, onMounted, watch } from 'vue';
export default {
    components: { ProfileLayout },
    props: {
        user_info: Object,
    },
    data: () => ({
        bread_cumb: [
            {
                title: 'profile',
                url: '/profile',
                active: false,
            },
            {
                title: 'account',
                url: '/profile/account',
                active: true,
            },
        ],

    }),
    setup() {
        const authStore = auth_store();
        const user_info = ref(authStore.auth_info);

        onMounted(async () => {
            if (authStore.is_auth) {
                user_info.value = authStore.auth_info;
            }
        });

        watch(() => authStore.auth_info, (newVal) => {
            user_info.value = newVal;
        });

        return {
            user_info,
        };
    },

    methods: {
        accountFormSubmitHandler: async function (event) {
            let formData = new FormData(event.target);
            let response = await window.privateAxios('/customers/account-info-update', 'post', formData);

            if (response.status === "success") {
                window.s_alert(response.message);
            }
        }
    },


};
</script>

<style></style>
