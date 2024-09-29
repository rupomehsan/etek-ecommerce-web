<template>
    <ProfileLayout :bread_cumb="bread_cumb">
        <div class="dashboard">
            <div class="page-title">
                <h2>
                    Change Password
                </h2>
            </div>
            <div class="box-account box-info">

                <form @submit.prevent="changePasswordHandler($event)" method="post" enctype="multipart/form-data">
                    <div class="form-group required">
                        <label for="current_password">Old Password</label>
                        <input type="password" name="current_password" value="" placeholder="Old Password" id="current_password"
                            class="form-control" />
                    </div>
                    <div class="form-group required">
                        <label for="new_password">New Password</label>
                        <input type="password" name="new_password" value="" placeholder="New Password" id="new_password"
                            class="form-control" />
                    </div>
                    <div class="form-group required">
                        <label for="confirm_password">Confirm Password</label>
                        <input type="password" name="confirm_password" value="" placeholder="Password Confirm"
                            id="confirm_password" class="form-control" />
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>


            </div>
        </div>
    </ProfileLayout>
</template>

<script>
import ProfileLayout from "../shared/ProfileLayout.vue";
export default {
    components: { ProfileLayout },
    data: () => ({
        bread_cumb: [
            {
                title: 'profile',
                url: '/profile',
                active: false,
            },
            {
                title: 'password',
                url: '/profile/password',
                active: true,
            },
        ]
    }),
    methods: {
        changePasswordHandler: async function (event) {
            let formData = new FormData(event.target);
            let response = await window.privateAxios('/customers/change-password', 'post', formData);

            if (response.status === "success") {
                window.s_alert(response.message);
            }
        }
    },
};
</script>

<style></style>
