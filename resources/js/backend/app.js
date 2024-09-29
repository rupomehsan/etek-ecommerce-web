import "./bootstrap";
import "./plugins/enToBn.js";
import "./plugins/axios_setup.js";
import "./plugins/sweet_alert.js";
import "./plugins/moment_setup";
import "./plugins/number_format.js";
import "./plugins/number_to_text_bangla.js";
import "./store/role.js";

import { createApp } from "vue";
import { createRouter, createWebHashHistory } from "vue-router";
import { createPinia } from "pinia";
import { CsvBuilder } from "filefy";

window.CsvBuilder = CsvBuilder;
//common components
import CommonInput from "./views/components/CommonInput.vue";
import ImageComponent from "../backend/views/components/ImageComponent.vue";
import Pagination from "../backend/views/components/Pagination.vue";
import DynamicSelect from "../backend/views/components/DynamicSelect.vue";
import DateField from "../backend/views/components/DateField.vue";
//app layout
import App from "./views/App.vue";
import MainDashboard from "./views/MainDashboard.vue";
//routes
import super_admin_route from "./views/pages/super_admin/partials/routes";
import admin_routes from "./views/pages/admin/partials/routes";
import accountant_routes from "./views/pages/accountant/partials/routes";
import delivery_man_routes from "./views/pages/delivery_man/partials/routes";
import employee_routes from "./views/pages/employee/partials/routes";
import retailer_routes from "./views/pages/retailer/partials/routes";
import sales_routes from "./views/pages/sales/partials/routes";
import supplier_routes from "./views/pages/supplier/partials/routes";
import app_config from "./app_config.js";



const router = createRouter({
    history: createWebHashHistory(),
    routes: [
        {
            path: "/",
            component: App,
            children: [
                {
                    path: "",
                    component: MainDashboard,
                },
                admin_routes,
                super_admin_route,
                accountant_routes,
                delivery_man_routes,
                employee_routes,
                retailer_routes,
                sales_routes,
                supplier_routes,
            ],
        },
    ],
});

router.beforeEach((to, from, next) => {
    to.href.length > 2 && window.sessionStorage.setItem("prevurl", to.href);
    next();
});

const pinia = createPinia();
const app = createApp({});

// Vue.prototype.number_format = (number = 0) => new Intl.NumberFormat().format(number);
app.component("app", App);
app.component("common-input", CommonInput);
app.component("image-component", ImageComponent);
app.component("pagination", Pagination);
app.component("dynamicSelect", DynamicSelect);
app.component("date-field", DateField);
app.use(pinia);
app.use(router);
app.mount("#app");
