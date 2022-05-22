export default function ({ store, redirect }) {
    if (store.$auth.loggedIn == true) {
        if (store.$auth.user.type == "admin") {
            redirect("/admin");
        } else {
            redirect("/customer");
        }

    }
}