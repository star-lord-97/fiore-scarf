<template>
    <div class="w-full">
        <div class="px-4">
            <div
                v-if="wishlistProducts.length > 0"
                class="container mx-auto my-8 space-y-8 flex flex-col"
            >
                <div class="w-full flex justify-between border-b pb-8">
                    <h1 class="font-semibold text-2xl">Wishlist</h1>
                    <h2 class="font-semibold text-2xl">
                        {{ wishlistProducts.length }} Item(s)
                    </h2>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div
                        v-for="product in wishlistProducts"
                        :key="product.code"
                        class="pb-4"
                    >
                        <ProductItem :product="product" />
                        <div class="flex justify-evenly">
                            <button
                                class="focus:outline-none transform transition duration-200 hover:scale-125 flex border p-2 rounded-lg"
                                @click.prevent="
                                    deleteFromWishlist(product.code)
                                "
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    height="24"
                                    viewBox="0 0 24 24"
                                    width="24"
                                    class="fill-current text-red-500 mr-2"
                                >
                                    <path d="M0 0h24v24H0z" fill="none" />
                                    <path
                                        d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4z"
                                    />
                                </svg>
                                <span class="text-red-500 font-bold"
                                    >Delete</span
                                >
                            </button>
                            <button
                                class="focus:outline-none transform transition duration-200 hover:scale-125 flex border py-2 px-4 rounded-lg bg-green-400 text-white font-bold"
                                @click.prevent="addToCart(product)"
                                v-if="product.sizes.length >= 1"
                            >
                                Buy Now
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <EmptyWishlist v-if="wishlistProducts.length == 0"></EmptyWishlist>
    </div>
</template>

<script>
import store from "../store";
import { computed } from "vue";
import EmptyWishlist from "../components/Wishlist/EmptyWishlist";
import ProductItem from "../components/Shop/ProductItem";
import { useRouter } from "vue-router";

export default {
    components: {
        EmptyWishlist,
        ProductItem,
    },

    setup() {
        const router = useRouter();

        const wishlistProducts = computed(() => {
            return store.getters.wishlist;
        });

        let deleteFromWishlist = (productCode) => {
            store.commit("toggleLoading", true);
            store.commit("deleteFromWishlist", { code: productCode });
            store.commit("toggleLoading", false);
        };

        let addToCart = (wishlistProduct) => {
            store.commit("toggleLoading", true);
            store.commit("addToCart", {
                product: wishlistProduct,
            });
            store.commit("toggleLoading", false);
            router.push("/cart");
        };

        return { deleteFromWishlist, addToCart, wishlistProducts };
    },
};
</script>

<style></style>
