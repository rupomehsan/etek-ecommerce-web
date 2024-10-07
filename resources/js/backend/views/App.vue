<template>
    <router-view></router-view>
</template>

<script>
import { mapActions, mapState } from "pinia";
import { use_auth_store } from "../store/auth_store";

export default {
    created: async function () {
        await this.check_is_auth();
    },
    watch: {
        is_auth: {
            handler: function (v) {
                let prev_url = window.sessionStorage.getItem("prevurl");
                switch (this.role.name) {
                    case "super_admin":
                        window.location.hash = prev_url || "#/superadmin";
                        break;
                    case "admin":
                        window.location.hash = prev_url || "#/admin";
                        break;

                    case "delivery_man":
                        window.location.hash = prev_url || "#/delivery-man";
                        break;
                    case "employee":
                        window.location.hash = prev_url || "#/employee";
                        break;
                    case "retailer":
                        window.location.hash = prev_url || "#/retailer";
                        break;
                    case "sales":
                        window.location.hash = prev_url || "#/sales-man";
                        break;
                    case "supplier":
                        window.location.hash = prev_url || "#/supplier";
                        break;
                    case "accountant":
                        window.location.hash = prev_url || "#/accountant";
                        break;

                    default:
                        console.log("you have no permission");
                }
            },
            deeps: true,
        },
    },
    methods: {
        ...mapActions(use_auth_store, {
            check_is_auth: "check_is_auth",
            log_out: "log_out",
        }),

        logOut() {
            alert("hi");
            this.log_out;
        },
    },
    computed: {
        ...mapState(use_auth_store, {
            is_auth: "is_auth",
            auth_info: "auth_info",
            role: "role",
        }),
    },
};
</script>

<style></style>
