import Layout from "./Layout.vue"
import Dashboard from "../Dashboard.vue"


const routes =
{
    path: 'employee',
    component: Layout,
    children: [
        {
            path: '',
            name: 'EmployeeAdminDashboard',
            component: Dashboard,
        },
    ]
};


export default routes;
