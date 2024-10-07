<template>
    <ProfileLayout :bread_cumb="bread_cumb">
        <div class="dashboard">
            <div class="page-title">
                <h2>
                    Edit Acount Information
                </h2>
            </div>
            <div class="box-account box-info">

                <form action="" method="post" @submit.prevent="accountFormSubmitHandler($event)" enctype="multipart/form-data"
                    class="form-horizontal">
                    <div class="multiple-form-group">
                        <div class="form-group required">
                            <label for="input-name">Name </label>
                            <input type="text" name="name" id="name" placeholder="Name" class="form-control">
                        </div>
                        <div class="form-group required">
                            <label for="input-user_name">User Name</label>
                            <input type="text" name="user_name" placeholder="User Name" id="user_name"
                                class="form-control">
                        </div>
                    </div>
                    <div class="form-group required">
                        <label for="input-email">E-Mail</label>
                        <input type="email" name="email" placeholder="E-Mail" readonly="" id="email"
                            class="form-control">
                    </div>
                    <div class="form-group required">
                        <label for="input-phone_number">Phone Number</label>
                        <input type="tel" name="phone_number" placeholder="Phone Number" readonly="" id="phone_number"
                            class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>

            </div>
        </div>
    </ProfileLayout>
</template>

<script>
import ProfileLayout from "../shared/ProfileLayout.vue";
import { useForm } from '@inertiajs/vue3'
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
        form: useForm({
            name: null,
            user_name: null,
            email: null,
            phone_number: null,
        })
    }),
    created() {
        this.form.reset()
        for (const key in this.user_info) {
            if (Object.hasOwnProperty.call(this.user_info, key)) {
                const element = this.user_info[key];
                this.form[key] = element
            }
        }
    },
    methods: {
        edit_account: function () {
            // axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('[name="csrf-token"]').content;
            // axios.post('login', new FormData(event.target))
            //     .then(res => { })
            console.log("edit submit clicked", this.form.name, this.form.user_name);

            this.form.clearErrors();
            this.form.post('/profile/edit-account');
        }
    }
};
</script>

<style></style>
