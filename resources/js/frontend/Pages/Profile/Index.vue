<template>
    <ProfileLayout :bread_cumb="bread_cumb">
        <div class="dashboard">
            <div class="page-title">
                <h2>My Dashboard</h2>
            </div>
            <div class="welcome-msg">
                <p>Hello, {{ user_info.name }} !</p>
                <p>
                    From your My Account Dashboard you have the ability to view a snapshot of your
                    recent account activity and update your account information. Select a link below
                    to view or edit information.
                </p>
            </div>
            <div class="box-account box-info">
                <div class="dashboard_cards">
                    <div class="item">
                        <h4 class="count">{{ user_dashboard_info.total_orders ?? 0 }}</h4>
                        <h5 class="title">Total Orders</h5>
                    </div>
                    <div class="item">
                        <h4 class="count">{{ user_dashboard_info.total_pending_orders ?? 0 }}</h4>
                        <h5 class="title">Pending Orders</h5>
                    </div>
                    <div class="item">
                        <h4 class="count">{{ user_dashboard_info.total_confirmed_orders ?? 0 }}</h4>
                        <h5 class="title">Confirmed Orders</h5>
                    </div>

                    <div class="item">
                        <h4 class="count">{{ user_dashboard_info.total_finished_orders ?? 0 }}</h4>
                        <h5 class="title">finished Orders</h5>
                    </div>
                </div>
            </div>
        </div>
    </ProfileLayout>
</template>

<script>
import ProfileLayout from "./shared/ProfileLayout.vue";
import { auth_store } from "../../Store/auth_store.js";
import { ref, onMounted, watch } from 'vue';
export default {
    components: { ProfileLayout },
    data: () => ({
        bread_cumb: [
            {
                title: 'profile',
                url: '/profile',
                active: true,
            },
        ],

        user_dashboard_info: {},
    }),

    created: async function () {
        await this.get_user_dashboard_info();
    },

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

        async get_user_dashboard_info() {
            let response = await window.privateAxios('/get-user-dashboard-info');
            this.user_dashboard_info = response.data;
        }
    },
};
</script>

<style></style>
