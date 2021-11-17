<template>
    <div class="h-80 w-full relative group">
        <a
            :href="'/product/' + product.code"
            class="w-full h-full z-10 absolute rounded-xl group-hover:block"
        >
            <button class="focus:outline-none" @click.prevent="addToWishlist">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="40"
                    height="40"
                    viewBox="0 0 256 256"
                    class="absolute bottom-6 left-6 transform transition duration-200 hover:scale-125"
                >
                    <rect width="256" height="256" fill="none"></rect>
                    <path
                        d="M128,216S28,160,28,92A52.00881,52.00881,0,0,1,128.00008,71.965l-.00019.00008A52.00881,52.00881,0,0,1,228,92C228,160,128,216,128,216Z"
                        :fill="
                            $store.getters.wishlist.find(
                                (wishlistProduct) =>
                                    wishlistProduct.code == product.code
                            )
                                ? '#595959'
                                : 'none'
                        "
                        stroke="#595959"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="16"
                    ></path>
                </svg>
            </button>
            <button
                v-if="product.sizes.length >= 1"
                class="focus:outline-none"
                @click.prevent="addToCart"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="40"
                    height="40"
                    :fill="
                        $store.getters.cart.find(
                            (cartProduct) => cartProduct.code == product.code
                        )
                            ? '#ffffff'
                            : ''
                    "
                    viewBox="0 0 256 256"
                    class="absolute bottom-6 left-20 transform transition duration-200 hover:scale-125"
                >
                    <rect width="256" height="256" fill="none"></rect>
                    <rect
                        x="32"
                        y="48"
                        width="192"
                        height="160"
                        rx="8"
                        :fill="
                            $store.getters.cart.find(
                                (cartProduct) =>
                                    cartProduct.code == product.code
                            )
                                ? '#595959'
                                : 'none'
                        "
                        stroke="#595959"
                        stroke-width="16"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    ></rect>
                    <path
                        d="M168,88a40,40,0,0,1-80,0"
                        fill="none"
                        :stroke="
                            $store.getters.cart.find(
                                (cartProduct) =>
                                    cartProduct.code == product.code
                            )
                                ? '#333333'
                                : '#595959'
                        "
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="16"
                    ></path>
                </svg>
            </button>
        </a>
        <img
            :src="
                product.image ? product.image : product.main_image[0].image_path
            "
            class="h-full w-full object-cover object-center rounded-xl"
            alt=""
        />
    </div>
    <a
        :href="'/product/' + product.code"
        class="font-normal text-xl my-4 block hover:text-gray-400 text-center md:text-left"
    >
        {{ product.name }}
    </a>
    <h1 class="font-normal text-xl my-4 text-gray-500 text-center md:text-left">
        E£{{ Number(product.price).toFixed(2) }}
    </h1>
</template>

<script>
import { computed } from "vue";
import { useRouter } from "vue-router";
import store from "../../store";

export default {
    props: ["product"],

    setup(props) {
        const router = useRouter();

        const isLoggedIn = computed(() => {
            return store.getters.isLoggedIn;
        });

        let addToCart = () => {
            if (!isLoggedIn.value) {
                router.push("/login");
            } else {
                store.commit("toggleLoading", true);
                store.commit("addToCart", { product: props.product });
                store.commit("toggleLoading", false);
                router.push("/cart");
            }
        };

        let addToWishlist = () => {
            if (!isLoggedIn.value) {
                router.push("/login");
            } else {
                store.commit("toggleLoading", true);
                store.commit("addToWishlist", { product: props.product });
                store.commit("toggleLoading", false);
                router.push("/wishlist");
            }
        };

        return { addToCart, addToWishlist, isLoggedIn };
    },
};
</script>

<style></style>
