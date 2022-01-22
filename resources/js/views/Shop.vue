<template>
    <div class="w-full">
        <div class="px-4">
            <div class="container mx-auto flex my-8 md:space-x-8">
                <ShopCategories
                    :categories="state.categories"
                    :showOnSaleCategory="state.showOnSaleCategory"
                ></ShopCategories>
                <div class="flex flex-col space-y-8 w-full">
                    <div class="flex justify-between items-center">
                        <span
                            class="font-bold text-sm md:text-3xl border-b-2 border-t-2 border-black py-2"
                            >{{
                                $route.params.category
                                    ? $route.params.category
                                    : "New In Store"
                            }}</span
                        >
                        <ShopSort
                            @sortedProducts="handleSortedProducts"
                        ></ShopSort>
                    </div>
                    <div
                        class="container mx-auto"
                        v-if="state.products.length > 0"
                    >
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div
                                v-for="product in state.products"
                                :key="product.id"
                            >
                                <ProductItem :product="product"></ProductItem>
                            </div>
                        </div>
                        <ShopPagination
                            :productsPagination="state.productsPagination"
                            @paginatedProducts="handlePaginatedProducts"
                        ></ShopPagination>
                    </div>
                    <div v-else class="w-full">No products to show</div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { onMounted, reactive } from "vue";
import store from "../store";
import ProductItem from "../components/Shop/ProductItem.vue";
import { onBeforeRouteUpdate, useRoute } from "vue-router";
import ShopSort from "../components/Shop/ShopSort.vue";
import ShopCategories from "../components/Shop/ShopCategories.vue";
import ShopPagination from "../components/Shop/ShopPagination.vue";

export default {
    components: {
        ProductItem,
        ShopSort,
        ShopCategories,
        ShopPagination,
    },

    setup() {
        const route = useRoute();

        const state = reactive({
            products: [],
            productsPagination: {},
            categories: [],
            showOnSaleCategory: false,
        });

        onBeforeRouteUpdate((to, from) => {
            store.commit("toggleLoading", true);
            if (!to.params.category) {
                store
                    .dispatch("getOneCategoryPage", {
                        category: "New In Store",
                    })
                    .then((response) => {
                        state.productsPagination = response.data;
                        state.products = response.data.data;
                        store.commit("toggleLoading", false);
                    });
            } else {
                store
                    .dispatch("getOneCategoryPage", {
                        category: to.params.category,
                    })
                    .then((response) => {
                        state.productsPagination = response.data;
                        state.products = response.data.data;
                        store.commit("toggleLoading", false);
                    });
            }
        });

        onMounted(() => {
            store.commit("toggleLoading", true);
            if (!route.params.category) {
                store
                    .dispatch("getOneCategoryPage", {
                        category: "New In Store",
                    })
                    .then((response) => {
                        state.productsPagination = response.data;
                        state.products = response.data.data;
                    });
            } else {
                store
                    .dispatch("getOneCategoryPage", {
                        category: route.params.category,
                    })
                    .then((response) => {
                        state.productsPagination = response.data;
                        state.products = response.data.data;
                    });
            }

            store.dispatch("getAllCategories").then((response) => {
                state.showOnSaleCategory = response.data.show_on_sale_category;
                state.categories = response.data.categories;
                store.commit("toggleLoading", false);
            });
        });

        let handleSortedProducts = (payload) => {
            state.productsPagination = payload.productsPagination;
            state.products = payload.products;
        };

        let handlePaginatedProducts = (payload) => {
            state.productsPagination = payload.productsPagination;
            state.products = payload.products;
        };

        return {
            state,
            handleSortedProducts,
            handlePaginatedProducts,
        };
    },
};
</script>
