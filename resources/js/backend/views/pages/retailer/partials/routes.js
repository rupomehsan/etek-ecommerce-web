import Layout from "./Layout.vue"
import Dashboard from "../Dashboard.vue"


const routes =
{
    path: 'retailer',
    component: Layout,
    children: [
        {
            path: '',
            name: 'RetailerAdminDashboard',
            component: Dashboard,
        },
    ]
};


export default routes;
