<template>
    <div class="relative font-inter min-h-screen flex flex-col justify-between">
        <div v-show="!$store.getters.isLoading">
            <Header @logout="handleLogout" />
        </div>
        <div
            class="flex justify-center items-center min-h-screen"
            v-if="$store.getters.isLoading"
        >
            <clip-loader color="black"></clip-loader>
        </div>
        <router-view
            class="pt-24 footer-padding-bottom"
            v-show="!$store.getters.isLoading"
        ></router-view>
        <div v-show="!$store.getters.isLoading">
            <Footer />
        </div>
    </div>
</template>

<script>
import Header from "./components/Header/Header";
import Footer from "./components/Footer/Footer";
import ClipLoader from "vue-spinner/src/ClipLoader.vue";
import store from "./store";
import { useRouter } from "vue-router";

export default {
    components: {
        Header,
        Footer,
        ClipLoader,
    },

    setup() {
        const router = useRouter();

        let handleLogout = () => {
            store.commit("toggleLoading", true);
            store.dispatch("logout").then((response) => {
                router.push("/");
                store.commit("toggleLoading", false);
            });
        };

        return { handleLogout };
    },
};
</script>

<style scoped>
.footer-padding-bottom {
    padding-bottom: 176px;
}

@media (min-width: 768px) {
    .footer-padding-bottom {
        padding-bottom: 250px;
    }
}
</style>
