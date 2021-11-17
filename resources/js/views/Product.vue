<template>
    <div class="w-full">
        <div class="px-4">
            <div class="container mx-auto flex flex-col space-y-8 my-8">
                <div class="grid grid-cols-1 md:grid-cols-2">
                    <ProductImages
                        v-if="state.product.images"
                        :images="state.product.images"
                    />
                    <div
                        class="flex flex-col text-center md:text-left space-y-8"
                    >
                        <h1 class="font-bold text-3xl">
                            {{ state.product.name }}
                        </h1>
                        <h1 class="text-gray-500 font-bold">
                            Code: {{ state.product.code }}
                        </h1>
                        <h1
                            v-if="state.product.sizes"
                            :class="
                                state.product.sizes.length <= 0
                                    ? 'text-red-500'
                                    : 'text-gray-500'
                            "
                        >
                            {{
                                state.product.sizes.length > 0
                                    ? "In stock"
                                    : "Out of stock"
                            }}
                        </h1>
                        <h1 class="font-bold text-3xl">
                            E£{{ Number(state.product.price).toFixed(2) }}
                        </h1>
                        <p>{{ state.product.details }}</p>
                        <ProductAddToCartOrWishlist
                            :sizes="state.product.sizes"
                            @addToWishlist="addToWishlist"
                            @addToCart="addToCart"
                        />
                    </div>
                </div>
                <h1 class="font-bold text-2xl">You might also like....</h1>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div
                        v-for="product in state.youMightAlsoLike"
                        :key="product.id"
                    >
                        <ProductItem :product="product" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import store from "../store";
import { computed, onMounted, reactive } from "vue";
import { useRoute, useRouter } from "vue-router";
import ProductImages from "../components/Product/ProductImages.vue";
import ProductAddToCartOrWishlist from "../components/Product/ProductAddToCartOrWishlist";
import ProductItem from "../components/Shop/ProductItem.vue";

export default {
    components: {
        ProductImages,
        ProductAddToCartOrWishlist,
        ProductItem,
    },

    setup() {
        const route = useRoute();
        const router = useRouter();

        const state = reactive({
            product: {},
            youMightAlsoLike: [],
        });

        const isLoggedIn = computed(() => {
            return store.getters.isLoggedIn;
        });

        onMounted(() => {
            store.commit("toggleLoading", true);
            store
                .dispatch("getOneProduct", { code: route.params.code })
                .then((response) => {
                    state.product = response.data;
                    store
                        .dispatch("getYouMightAlsoLikeProduct", {
                            code: route.params.code,
                        })
                        .then((response) => {
                            state.youMightAlsoLike = response.data;
                            store.commit("toggleLoading", false);
                        });
                });
        });

        let addToWishlist = () => {
            if (!isLoggedIn.value) {
                router.push("/login");
            } else {
                store.commit("toggleLoading", true);
                store.commit("addToWishlist", { product: state.product });
                store.commit("toggleLoading", false);
                router.push("/wishlist");
            }
        };

        let addToCart = (payload) => {
            if (!isLoggedIn.value) {
                router.push("/login");
            } else {
                store.commit("toggleLoading", true);
                store.commit("addToCart", {
                    product: state.product,
                    size: payload.size,
                    quantity: payload.quantity,
                });
                store.commit("toggleLoading", false);
                router.push("/cart");
            }
        };

        return { state, addToWishlist, addToCart };
    },
};
</script>
