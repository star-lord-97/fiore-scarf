export default {
    setHeroExt(state) {
        state.heroExt = localStorage.getItem("heroExt");
    },

    LOGIN(state) {
        state.token = localStorage.getItem("token");
    },

    ADMIN(state) {
        state.admin = localStorage.getItem("admin");
    },

    saveEmail(state) {
        state.email = localStorage.getItem("email");
    },

    clearToken(state) {
        state.token = null;
    },

    clearAdmin(state) {
        state.admin = null;
    },

    clearEmail(state) {
        state.email = null;
        localStorage.removeItem("email");
    },

    toggleLoading(state, payload) {
        state.loading = payload;
    },

    getCartFromLocalStorage(state) {
        state.cart =
            JSON.parse(localStorage.getItem("cart_" + state.email)) || [];
    },

    getWishlistFromLocalStorage(state) {
        state.wishlist =
            JSON.parse(localStorage.getItem("wishlist_" + state.email)) || [];
    },

    addToWishlist(state, payload) {
        let found = state.wishlist.find(
            (product) => product.code == payload.product.code
        );

        if (!found) {
            state.wishlist.push({
                id: payload.product.id,
                code: payload.product.code,
                name: payload.product.name,
                price: payload.product.price,
                sizes: payload.product.sizes,
                image: payload.product.main_image[0].image_path,
            });
        }

        localStorage.setItem(
            "wishlist_" + state.email,
            JSON.stringify(state.wishlist)
        );
    },

    deleteFromWishlist(state, payload) {
        state.wishlist = state.wishlist.filter(
            (product) => product.code !== payload.code
        );

        localStorage.setItem(
            "wishlist_" + state.email,
            JSON.stringify(state.wishlist)
        );
    },

    emptyWishlist(state) {
        state.wishlist = [];

        localStorage.setItem(
            "wishlist_" + state.email,
            JSON.stringify(state.wishlist)
        );
    },

    addToCart(state, payload) {
        let found = state.cart.find(
            (product) => product.code == payload.product.code
        );

        if (!found) {
            state.cart.push({
                id: payload.product.id,
                code: payload.product.code,
                name: payload.product.name,
                price: payload.product.price,
                size: payload.size
                    ? payload.size
                    : payload.product.sizes[0].size,
                sizes: payload.product.sizes,
                quantity: payload.quantity ? payload.quantity : 1,
                image: payload.product.main_image
                    ? payload.product.main_image[0].image_path
                    : payload.product.image,
            });
        } else {
            let index = state.cart.findIndex(
                (product) => product.code == payload.product.code
            );

            state.cart[index].quantity = payload.quantity
                ? payload.quantity
                : state.cart[index].quantity;

            state.cart[index].size = payload.size
                ? payload.size
                : state.cart[index].size;
        }

        localStorage.setItem("cart_" + state.email, JSON.stringify(state.cart));
    },

    updateCart(state, payload) {
        let index = state.cart.findIndex(
            (product) => product.code == payload.code
        );

        if (payload.quantityPlusOne)
            state.cart[index].quantity = ++state.cart[index].quantity;

        if (payload.quantityMinusOne && state.cart[index].quantity > 1)
            state.cart[index].quantity = --state.cart[index].quantity;

        if (payload.size) state.cart[index].size = payload.size;

        localStorage.setItem("cart_" + state.email, JSON.stringify(state.cart));
    },

    deleteFromCart(state, payload) {
        state.cart = state.cart.filter(
            (product) => product.code !== payload.code
        );

        localStorage.setItem("cart_" + state.email, JSON.stringify(state.cart));
    },

    emptyCart(state) {
        state.cart = [];

        localStorage.setItem("cart_" + state.email, JSON.stringify(state.cart));
    },
};
