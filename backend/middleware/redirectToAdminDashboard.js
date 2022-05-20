export default function ({ route, redirect }) {
    if (route.path === '/admin' || route.path === "/admin/") {
        redirect('/admin/dashboard');
    }
}