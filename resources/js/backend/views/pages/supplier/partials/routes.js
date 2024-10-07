import Layout from "./Layout.vue"
import Dashboard from "../Dashboard.vue"


const routes =
{
    path: 'supplier',
    component: Layout,
    children: [
        {
            path: '',
            name: 'SupplierAdminDashboard',
            component: Dashboard,
        },
    ]
};


export default routes;
