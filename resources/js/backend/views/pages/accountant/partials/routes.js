import Layout from "./Layout.vue"
import Dashboard from "../Dashboard.vue"


const routes =
{
    path: 'accountant',
    component: Layout,
    children: [
        {
            path: '',
            name: 'AccountantAdminDashboard',
            component: Dashboard,
        },
    ]
};


export default routes;
