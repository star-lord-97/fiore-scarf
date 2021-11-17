<template>
    <span
        ><span class="hidden md:inline">Price: </span>
        <button
            class="focus:outline-none hover:text-gray-400 block md:inline"
            :class="state.sorted.asc ? 'text-gray-400' : ''"
            @click.prevent="sort('asc')"
        >
            <span class="inline md:hidden">Price </span>Low to High
        </button>
        <span class="hidden md:inline"> | </span>
        <button
            class="focus:outline-none hover:text-gray-400"
            :class="state.sorted.desc ? 'text-gray-400' : ''"
            @click.prevent="sort('desc')"
        >
            <span class="inline md:hidden">Price </span>High to Low
        </button></span
    >
</template>

<script>
import { reactive } from "vue";
import { onBeforeRouteUpdate, useRoute } from "vue-router";
import store from "../../store";

export default {
    emits: ["sortedProducts"],

    setup(props, { emit }) {
        const route = useRoute();

        const state = reactive({
            sorted: {
                asc: false,
                desc: false,
            },
        });

        onBeforeRouteUpdate((to, from) => {
            if (to.params.category != from.params.category) {
                state.sorted.asc = false;
                state.sorted.desc = false;
            }
        });

        let sort = (sortingMethod) => {
            if (!route.params.category) {
                store.commit("toggleLoading", true);
                store
                    .dispatch("getOneSortedCategoryPage", {
                        category: "New In Store",
                        method: sortingMethod,
                    })
                    .then((response) => {
                        emit("sortedProducts", {
                            productsPagination: response.data,
                            products: response.data.data,
                        });
                        sortingMethod === "asc"
                            ? ((state.sorted.asc = true),
                              (state.sorted.desc = false))
                            : ((state.sorted.asc = false),
                              (state.sorted.desc = true));
                        store.commit("toggleLoading", false);
                    });
            } else {
                store.commit("toggleLoading", true);
                store
                    .dispatch("getOneSortedCategoryPage", {
                        category: route.params.category,
                        method: sortingMethod,
                    })
                    .then((response) => {
                        emit("sortedProducts", {
                            productsPagination: response.data,
                            products: response.data.data,
                        });
                        sortingMethod === "asc"
                            ? ((state.sorted.asc = true),
                              (state.sorted.desc = false))
                            : ((state.sorted.asc = false),
                              (state.sorted.desc = true));
                        store.commit("toggleLoading", false);
                    });
            }
        };

        return { state, sort };
    },
};
</script>

<style></style>
