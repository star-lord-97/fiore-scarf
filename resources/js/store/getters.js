export default {
    isLoggedIn(state) {
        return state.token !== null;
    },

    isAdmin(state) {
        return state.admin !== null && state.admin !== false;
    },

    isLoading(state) {
        return state.loading;
    },

    wishlist(state) {
        return state.wishlist;
    },

    cart(state) {
        return state.cart;
    },

    heroExt(state) {
        return state.heroExt;
    },
};
