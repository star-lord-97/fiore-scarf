import axios from "axios";

export default {
    getHomeProducts(context) {
        return new Promise((resolve, reject) => {
            axios.defaults.headers.common["Authorization"] =
                "Bearer " + context.state.token;
            axios
                .get(context.state.baseAPIURL + "/home")
                .then((response) => {
                    resolve(response);
                })
                .catch((error) => {
                    reject(error);
                });
        });
    },

    getOneProduct(context, payload) {
        return new Promise((resolve, reject) => {
            axios
                .get(context.state.baseAPIURL + "/products/" + payload.code)
                .then((response) => {
                    resolve(response);
                })
                .catch((error) => {
                    reject(error);
                });
        });
    },

    getYouMightAlsoLikeProduct(context, payload) {
        return new Promise((resolve, reject) => {
            axios.defaults.headers.common["Authorization"] =
                "Bearer " + context.state.token;
            axios
                .get(
                    context.state.baseAPIURL +
                        "/you_might_also_like/" +
                        payload.code
                )
                .then((response) => {
                    resolve(response);
                })
                .catch((error) => {
                    reject(error);
                });
        });
    },

    getAllCategories(context) {
        return new Promise((resolve, reject) => {
            axios
                .get(context.state.baseAPIURL + "/categories")
                .then((response) => {
                    resolve(response);
                })
                .catch((error) => {
                    reject(error);
                });
        });
    },

    getOneCategoryPage(context, payload) {
        let url = "";
        if (!payload.pageURL) {
            url = context.state.baseAPIURL + "/categories/" + payload.category;
        } else {
            url = payload.pageURL;
        }

        return new Promise((resolve, reject) => {
            axios
                .get(url)
                .then((response) => {
                    resolve(response);
                })
                .catch((error) => {
                    reject(error);
                });
        });
    },

    getOneSortedCategoryPage(context, payload) {
        let url = "";
        if (!payload.pageURL) {
            url =
                context.state.baseAPIURL +
                "/categories/" +
                payload.category +
                "/sort/" +
                payload.method;
        } else {
            url = payload.pageURL;
        }

        return new Promise((resolve, reject) => {
            axios
                .get(url)
                .then((response) => {
                    resolve(response);
                })
                .catch((error) => {
                    reject(error);
                });
        });
    },

    getPromoCodeDiscount(context, payload) {
        axios.defaults.headers.common["Authorization"] =
            "Bearer " + context.state.token;
        return new Promise((resolve, reject) => {
            axios
                .get(
                    context.state.baseAPIURL +
                        "/promo-codes/" +
                        payload.promoCode,
                    { params: { subTotal: payload.subTotal } }
                )
                .then((response) => {
                    resolve(response);
                })
                .catch((error) => {
                    reject(error);
                });
        });
    },

    register(context, payload) {
        return new Promise((resolve, reject) => {
            axios
                .post(
                    context.state.baseAPIURL + "/register",
                    payload.credentials
                )
                .then((response) => {
                    resolve(response);
                })
                .catch((error) => {
                    reject(error);
                });
        });
    },

    login(context, payload) {
        return new Promise((resolve, reject) => {
            axios
                .post(context.state.baseAPIURL + "/login", payload.credentials)
                .then((response) => {
                    localStorage.setItem("token", response.data);
                    localStorage.setItem("email", payload.credentials.email);
                    context.commit("LOGIN");
                    context.commit("saveEmail");
                    context.commit("getCartFromLocalStorage");
                    context.commit("getWishlistFromLocalStorage");
                    context.dispatch("isAdmin");
                    resolve(response);
                })
                .catch((error) => {
                    reject(error);
                });
        });
    },

    getUserData(context) {
        return new Promise((resolve, reject) => {
            axios.defaults.headers.common["Authorization"] =
                "Bearer " + context.state.token;
            axios
                .get(context.state.baseAPIURL + "/user")
                .then((response) => {
                    resolve(response);
                })
                .catch((error) => {
                    reject(error);
                });
        });
    },

    updateUser(context, payload) {
        return new Promise((resolve, reject) => {
            axios.defaults.headers.common["Authorization"] =
                "Bearer " + context.state.token;
            axios
                .put(context.state.baseAPIURL + "/user", {
                    name: payload.userInfo.name,
                    phone: payload.userInfo.phone,
                    address: payload.userInfo.address,
                    city: payload.userInfo.city,
                })
                .then((response) => {
                    resolve(response);
                })
                .catch((error) => {
                    reject(error);
                });
        });
    },

    isAdmin(context) {
        return new Promise((resolve, reject) => {
            axios.defaults.headers.common["Authorization"] =
                "Bearer " + context.state.token;
            axios
                .get(context.state.baseAPIURL + "/user")
                .then((response) => {
                    if (
                        response.data.is_admin === "1" ||
                        response.data.is_admin === 1
                    ) {
                        localStorage.setItem("admin", true);
                        context.commit("ADMIN");
                    }
                    resolve(response);
                })
                .catch((error) => {
                    reject(error);
                });
        });
    },

    logout(context) {
        return new Promise((resolve, reject) => {
            axios.defaults.headers.common["Authorization"] =
                "Bearer " + context.state.token;
            axios
                .post(context.state.baseAPIURL + "/logout")
                .then((response) => {
                    localStorage.removeItem("token");
                    localStorage.removeItem("admin");
                    context.commit("clearToken");
                    context.commit("clearAdmin");
                    context.commit("clearEmail");
                    resolve(response);
                })
                .catch((error) => {
                    localStorage.removeItem("token");
                    localStorage.removeItem("admin");
                    context.commit("clearToken");
                    context.commit("clearAdmin");
                    reject(error);
                });
        });
    },

    subscribeToNewsletter(context, payload) {
        return new Promise((resolve, reject) => {
            axios
                .post(context.state.baseAPIURL + "/newsletter", {
                    email: payload.email,
                })
                .then((response) => {
                    resolve(response);
                })
                .catch((error) => {
                    reject(error);
                });
        });
    },

    checkout(context, payload) {
        axios.defaults.headers.common["Authorization"] =
            "Bearer " + context.state.token;
        return new Promise((resolve, reject) => {
            axios
                .post(context.state.baseAPIURL + "/checkout", {
                    subTotal: payload.subTotal,
                    promoCode: payload.promoCode,
                    total: payload.total,
                    products: payload.products,
                    notes: payload.notes,
                })
                .then((response) => {
                    resolve(response);
                })
                .catch((error) => {
                    reject(error);
                });
        });
    },

    adminChangeHomeVideo(context, payload) {
        return new Promise((resolve, reject) => {
            axios.defaults.headers.common["Authorization"] =
                "Bearer " + context.state.token;

            axios
                .post(context.state.baseAPIURL + "/home", payload, {
                    headers: {
                        "Content-Type": "null",
                    },
                })
                .then((response) => {
                    localStorage.setItem("heroExt", response.data);
                    context.commit("setHeroExt");
                    resolve(response);
                })
                .catch((error) => {
                    reject(error);
                });
        });
    },

    adminExportUsers(context) {
        return new Promise((resolve, reject) => {
            axios.defaults.headers.common["Authorization"] =
                "Bearer " + context.state.token;

            axios
                .get(context.state.baseAPIURL + "/users/export", {
                    responseType: "blob",
                })
                .then((response) => {
                    resolve(response);
                })
                .catch((error) => {
                    reject(error);
                });
        });
    },

    adminGetAllUsers(context) {
        return new Promise((resolve, reject) => {
            axios.defaults.headers.common["Authorization"] =
                "Bearer " + context.state.token;

            axios
                .get(context.state.baseAPIURL + "/users")
                .then((response) => {
                    resolve(response);
                })
                .catch((error) => {
                    reject(error);
                });
        });
    },

    adminGetAllAdmins(context) {
        return new Promise((resolve, reject) => {
            axios.defaults.headers.common["Authorization"] =
                "Bearer " + context.state.token;

            axios
                .get(context.state.baseAPIURL + "/admins")
                .then((response) => {
                    resolve(response);
                })
                .catch((error) => {
                    reject(error);
                });
        });
    },

    adminMakeAdmins(context, payload) {
        return new Promise((resolve, reject) => {
            axios.defaults.headers.common["Authorization"] =
                "Bearer " + context.state.token;
            axios
                .post(context.state.baseAPIURL + "/admins/" + payload.email)
                .then((response) => {
                    resolve(response);
                })
                .catch((error) => {
                    reject(error);
                });
        });
    },

    adminRemoveAdmins(context, payload) {
        return new Promise((resolve, reject) => {
            axios.defaults.headers.common["Authorization"] =
                "Bearer " + context.state.token;

            axios
                .delete(context.state.baseAPIURL + "/admins/" + payload.id)
                .then((response) => {
                    resolve(response);
                })
                .catch((error) => {
                    reject(error);
                });
        });
    },

    adminGetAllPromoCodes(context) {
        return new Promise((resolve, reject) => {
            axios.defaults.headers.common["Authorization"] =
                "Bearer " + context.state.token;

            axios
                .get(context.state.baseAPIURL + "/promo-codes")
                .then((response) => {
                    resolve(response);
                })
                .catch((error) => {
                    reject(error);
                });
        });
    },

    adminAddNewPromoCode(context, payload) {
        return new Promise((resolve, reject) => {
            axios.defaults.headers.common["Authorization"] =
                "Bearer " + context.state.token;

            axios
                .post(context.state.baseAPIURL + "/promo-codes", payload)
                .then((response) => {
                    resolve(response);
                })
                .catch((error) => {
                    reject(error);
                });
        });
    },

    adminRemovePromoCode(context, payload) {
        return new Promise((resolve, reject) => {
            axios.defaults.headers.common["Authorization"] =
                "Bearer " + context.state.token;

            axios
                .delete(
                    context.state.baseAPIURL + "/promo-codes/" + payload.code
                )
                .then((response) => {
                    resolve(response);
                })
                .catch((error) => {
                    reject(error);
                });
        });
    },

    adminGetAllProducts(context) {
        return new Promise((resolve, reject) => {
            axios.defaults.headers.common["Authorization"] =
                "Bearer " + context.state.token;

            axios
                .get(context.state.baseAPIURL + "/products")
                .then((response) => {
                    resolve(response);
                })
                .catch((error) => {
                    reject(error);
                });
        });
    },

    adminAddNewProduct(context, payload) {
        return new Promise((resolve, reject) => {
            axios.defaults.headers.common["Authorization"] =
                "Bearer " + context.state.token;

            axios
                .post(context.state.baseAPIURL + "/products", payload, {
                    headers: {
                        "Content-Type": "null",
                    },
                })
                .then((response) => {
                    resolve(response);
                })
                .catch((error) => {
                    reject(error);
                });
        });
    },

    adminUpdateProduct(context, payload) {
        return new Promise((resolve, reject) => {
            axios.defaults.headers.common["Authorization"] =
                "Bearer " + context.state.token;
            axios
                .patch(context.state.baseAPIURL + "/products/" + payload.code, {
                    attribute: payload.attribute,
                    price: payload.price ? payload.price : null,
                })
                .then((response) => {
                    resolve(response);
                })
                .catch((error) => {
                    reject(error);
                });
        });
    },

    adminRemoveProduct(context, payload) {
        return new Promise((resolve, reject) => {
            axios.defaults.headers.common["Authorization"] =
                "Bearer " + context.state.token;

            axios
                .delete(context.state.baseAPIURL + "/products/" + payload.code)
                .then((response) => {
                    resolve(response);
                })
                .catch((error) => {
                    reject(error);
                });
        });
    },

    adminGetAllOrders(context) {
        return new Promise((resolve, reject) => {
            axios.defaults.headers.common["Authorization"] =
                "Bearer " + context.state.token;

            axios
                .get(context.state.baseAPIURL + "/orders")
                .then((response) => {
                    resolve(response);
                })
                .catch((error) => {
                    reject(error);
                });
        });
    },

    adminUpdateOrderShipment(context, payload) {
        return new Promise((resolve, reject) => {
            axios.defaults.headers.common["Authorization"] =
                "Bearer " + context.state.token;
            axios
                .patch(context.state.baseAPIURL + "/orders/" + payload.id)
                .then((response) => {
                    resolve(response);
                })
                .catch((error) => {
                    reject(error);
                });
        });
    },

    // sendResetEmail(context, payload) {
    //     return new Promise((resolve, reject) => {
    //         axios
    //             .post(context.state.baseAPIURL + "/forgot", payload.email)
    //             .then((response) => {
    //                 resolve(response);
    //             })
    //             .catch((error) => {
    //                 reject(error);
    //             });
    //     });
    // },
};
