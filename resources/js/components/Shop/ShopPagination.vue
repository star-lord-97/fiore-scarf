<template>
    <div class="flex justify-between">
        <button
            class="focus:outline-none hover:text-gray-400"
            v-if="productsPagination.prev_page_url"
            @click.prevent="changePage(productsPagination.prev_page_url)"
        >
            &lt;&lt; Prev
        </button>
        <div v-else></div>
        <button
            class="focus:outline-none hover:text-gray-400"
            v-if="productsPagination.next_page_url"
            @click.prevent="changePage(productsPagination.next_page_url)"
        >
            Next &gt;&gt;
        </button>
        <div v-else></div>
    </div>
</template>

<script>
import store from "../../store";

export default {
    props: ["productsPagination"],
    emits: ["paginatedProducts"],

    setup(props, { emit }) {
        let changePage = (url) => {
            store.commit("toggleLoading", true);
            store
                .dispatch("getOneCategoryPage", {
                    pageURL: url,
                })
                .then((response) => {
                    emit("paginatedProducts", {
                        productsPagination: response.data,
                        products: response.data.data,
                    });
                    store.commit("toggleLoading", false);
                });
        };

        return { changePage };
    },
};
</script>

<style></style>
