export default {
    baseAPIURL: "http://localhost:8000/api",
    // baseAPIURL: "http://fiore-scarf.com/api",
    heroExt: localStorage.getItem("heroExt") || "qt",
    token: localStorage.getItem("token") || null,
    admin: localStorage.getItem("admin") || false,
    loading: false,
    email: localStorage.getItem("email") || null,
    wishlist:
        JSON.parse(
            localStorage.getItem("wishlist_" + localStorage.getItem("email"))
        ) || [],
    cart:
        JSON.parse(
            localStorage.getItem("cart_" + localStorage.getItem("email"))
        ) || [],
};
