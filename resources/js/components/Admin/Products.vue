<template>
    <div class="flex flex-col justify-center items-center space-y-4">
        <button
            class="
                focus:outline-none
                px-2
                py-1.5
                bg-green-500
                rounded-lg
                text-white
                transform
                transition
                duration-200
                hover:scale-105
            "
            @click.prevent="state.showAddNewProductModal = true"
        >
            Add new product
        </button>
        <table
            class="border border-green-100 text-center table-fixed"
            v-if="state.products.length > 0"
        >
            <thead>
                <tr>
                    <th class="border border-green-100 py-1">Code</th>
                    <th class="border border-green-100 py-1">Name</th>
                    <th class="border border-green-100 py-1">Price</th>
                    <th class="border border-green-100 py-1">Category</th>
                    <th class="border border-green-100 py-1">Stock</th>
                    <th class="border border-green-100 py-1">Sale?</th>
                    <th class="border border-green-100 py-1">Remove</th>
                    <th
                        class="border border-green-100 py-1"
                        v-if="state.showUpdateButton"
                    >
                        Update?!
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="product in state.products" :key="product.id">
                    <td class="border border-green-100 px-4 py-2">
                        {{ product.code }}
                    </td>
                    <td class="border border-green-100 px-4 py-2">
                        <a
                            :href="'/product/' + product.code"
                            class="underline hover:no-underline"
                        >
                            {{ product.name }}
                        </a>
                    </td>
                    <td class="border border-green-100 px-4 py-2">
                        <div class="flex items-center space-x-1">
                            <span>E£</span>
                            <input
                                type="text"
                                name="price"
                                class="
                                    focus:outline-none
                                    border
                                    focus:border-blue-300
                                    w-32
                                "
                                :placeholder="product.price"
                                @input="
                                    state.productCodeToUpdate = product.code;
                                    state.priceToBeUpdated =
                                        $event.target.value;
                                    state.showUpdateButton = true;
                                "
                            />
                        </div>
                    </td>
                    <td class="border border-green-100 px-4 py-2">
                        {{ product.category }}
                    </td>
                    <td class="border border-green-100 px-4 py-2">
                        <span
                            v-if="product.sizes.length <= 0"
                            class="text-red-500"
                            >Out of stock</span
                        >
                        <div v-else class="space-y-1">
                            <input
                                v-for="size in product.sizes"
                                :key="size.id"
                                type="text"
                                name="price"
                                class="
                                    focus:outline-none
                                    border
                                    focus:border-blue-300
                                    w-32
                                "
                                :placeholder="size['units']"
                                @input="
                                    state.productCodeToUpdate = product.code;
                                    state.unitsToBeUpdated =
                                        $event.target.value;
                                    state.showUpdateButton = true;
                                "
                            />
                            <span> Pieces</span>
                        </div>
                    </td>
                    <td class="border border-green-100 px-4 py-2">
                        <button
                            class="
                                focus:outline-none
                                px-4
                                py-1
                                rounded-lg
                                text-white
                                transform
                                transition
                                duration-200
                                hover:scale-105
                            "
                            :class="
                                product.sale === '1' || product.sale === 1
                                    ? 'bg-red-500'
                                    : 'bg-green-500'
                            "
                            @click="toggleSale(product.code)"
                        >
                            {{
                                product.sale === "1" || product.sale === 1
                                    ? "Remove sale"
                                    : "Put on sale"
                            }}
                        </button>
                    </td>
                    <td class="border border-green-100 px-4 py-2">
                        <button
                            class="
                                focus:outline-none
                                transform
                                transition
                                duration-200
                                hover:scale-125
                            "
                            @click.prevent="
                                state.showRemoveProductConfirmationModal = true;
                                state.productCodeToRemove = product.code;
                            "
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                height="24"
                                viewBox="0 0 24 24"
                                width="24"
                                class="fill-current text-red-500 mx-auto"
                            >
                                <path d="M0 0h24v24H0z" fill="none" />
                                <path
                                    d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4z"
                                />
                            </svg>
                        </button>
                    </td>
                    <td
                        class="border border-green-100 px-4 py-2"
                        v-if="state.showUpdateButton"
                    >
                        <svg
                            viewBox="0 0 24 24"
                            class="h-6 w-6"
                            v-show="product.code == state.productCodeToUpdate"
                            @click="
                                state.priceToBeUpdated !== null
                                    ? updatePrice()
                                    : updateUnits()
                            "
                        >
                            <path d="M0 0h24v24H0V0z" fill="none" />
                            <path
                                d="M9 16.2L4.8 12l-1.4 1.4L9 19 21 7l-1.4-1.4L9 16.2z"
                            />
                        </svg>
                    </td>
                </tr>
            </tbody>
        </table>
        <div v-else>No products in the database yet.</div>
    </div>
    <AddNewProductModal
        v-if="state.showAddNewProductModal"
        :errors="state.errors"
        @closeModal="state.showAddNewProductModal = false"
        @addProduct="addProduct"
    />
    <RemoveProductConfirmationModal
        v-if="state.showRemoveProductConfirmationModal"
        @closeModal="state.showRemoveProductConfirmationModal = false"
        @removeProduct="removeProduct"
    />
</template>

<script>
import { onMounted, reactive } from "vue";
import store from "../../store";
import AddNewProductModal from "./Products/AddNewProductModal.vue";
import RemoveProductConfirmationModal from "./Products/RemoveProductConfirmationModal.vue";
import { useRouter } from "vue-router";

export default {
    components: {
        AddNewProductModal,
        RemoveProductConfirmationModal,
    },

    setup() {
        const router = useRouter();

        const state = reactive({
            products: [],
            errors: [],
            showAddNewProductModal: false,
            showRemoveProductConfirmationModal: false,
            productCodeToRemove: "",
            productCodeToUpdate: "",
            priceToBeUpdated: null,
            showUpdateButton: false,
            unitsToBeUpdated: null,
        });

        onMounted(() => {
            store.commit("toggleLoading", true);
            store.dispatch("adminGetAllProducts").then((response) => {
                state.products = response.data;
                store.commit("toggleLoading", false);
            });
        });

        let addProduct = (payload) => {
            store.commit("toggleLoading", true);
            store
                .dispatch("adminAddNewProduct", payload)
                .then((response) => {
                    state.products = response.data;
                    state.showAddNewProductModal = false;
                    store.commit("toggleLoading", false);
                    router.push("/shop");
                })
                .catch((error) => {
                    if (error.response.status === 422) {
                        state.errors = error.response.data.errors;
                        store.commit("toggleLoading", false);
                    }
                });
        };

        let removeProduct = () => {
            store.commit("toggleLoading", true);
            state.showRemoveProductConfirmationModal = false;
            store
                .dispatch("adminRemoveProduct", {
                    code: state.productCodeToRemove,
                })
                .then((response) => {
                    state.products = response.data;
                    store.commit("toggleLoading", false);
                });
        };

        let updatePrice = () => {
            store.commit("toggleLoading", true);
            store
                .dispatch("adminUpdateProduct", {
                    code: state.productCodeToUpdate,
                    attribute: "price",
                    price: state.priceToBeUpdated,
                })
                .then((response) => {
                    state.products = response.data;
                    state.productCodeToUpdate = "";
                    state.priceToBeUpdated = null;
                    state.showUpdateButton = false;
                    store.commit("toggleLoading", false);
                });
        };

        let updateUnits = () => {
            store.commit("toggleLoading", true);
            store
                .dispatch("adminUpdateProduct", {
                    code: state.productCodeToUpdate,
                    attribute: "units",
                    units: state.unitsToBeUpdated,
                })
                .then((response) => {
                    state.products = response.data;
                    state.productCodeToUpdate = "";
                    state.unitsToBeUpdated = null;
                    state.showUpdateButton = false;
                    store.commit("toggleLoading", false);
                });
        };

        let toggleSale = (productCode) => {
            store.commit("toggleLoading", true);
            store
                .dispatch("adminUpdateProduct", {
                    code: productCode,
                    attribute: "sale",
                })
                .then((response) => {
                    state.products = response.data;
                    store.commit("toggleLoading", false);
                });
        };

        return {
            state,
            addProduct,
            removeProduct,
            updatePrice,
            toggleSale,
            updateUnits,
        };
    },
};
</script>

<style></style>
