import Layout from "./Layout.vue"
import Dashboard from "../Dashboard.vue"


const routes =
{
    path: 'delivery-man',
    component: Layout,
    children: [
        {
            path: '',
            name: 'DeliveryManAdminDashboard',
            component: Dashboard,
        },
    ]
};


export default routes;
