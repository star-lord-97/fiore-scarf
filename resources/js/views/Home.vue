<template>
    <div class="w-full">
        <div class="md:px-4">
            <div class="container mx-auto flex flex-col space-y-8 mb-8">
                <HomeHero />
                <h1 class="text-center text-3xl">HOT DEALS</h1>
                <HomeHotDeals />
                <h1 class="text-center text-3xl">NEW IN STORE</h1>
                <div
                    class="container mx-auto grid grid-cols-1 md:grid-cols-3 gap-4 px-4"
                    v-show="state.products.length > 0"
                >
                    <div v-for="product in state.products" :key="product.id">
                        <ProductItem :product="product"></ProductItem>
                    </div>
                </div>
                <div class="flex justify-center items-center">
                    <router-link
                        to="/shop"
                        class="py-2 px-4 rounded-lg text-white text-center font-bold hover:scale-110 transform transition duration-200"
                        style="background-color: #6d8e97"
                    >
                        Explore More
                    </router-link>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { onMounted, reactive } from "vue";
import HomeHero from "../components/Home/HomeHero.vue";
import HomeHotDeals from "../components/Home/HomeHotDeals.vue";
import ProductItem from "../components/Shop/ProductItem.vue";
import store from "../store";

export default {
    components: { HomeHero, HomeHotDeals, ProductItem },

    setup() {
        const state = reactive({
            products: [],
        });

        onMounted(() => {
            store.commit("toggleLoading", true);
            store.dispatch("getHomeProducts").then((response) => {
                state.products = response.data;
                store.commit("toggleLoading", false);
            });
        });

        return { state };
    },
};
</script>
