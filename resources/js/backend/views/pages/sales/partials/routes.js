import Layout from "./Layout.vue"
import Dashboard from "../Dashboard.vue"


const routes =
{
    path: 'sales-man',
    component: Layout,
    children: [
        {
            path: '',
            name: 'SalesAdminDashboard',
            component: Dashboard,
        },
    ]
};


export default routes;
