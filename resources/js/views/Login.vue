<template>
    <div class="w-full">
        <div
            class="container mx-auto flex flex-col items-center justify-center my-8"
        >
            <h2 class="my-8 text-center text-3xl font-bold">
                Sign in to your account
            </h2>
            <div class="w-4/5 md:w-1/3 flex flex-col">
                <input
                    v-model="state.credentials.email"
                    id="email-address"
                    name="email-address"
                    type="email"
                    autocomplete="email"
                    class="p-4 focus:outline-none focus:border-blue-400 border w-full rounded-lg my-1"
                    placeholder="Email Address"
                />
                <span
                    class="text-red-700 font-bold"
                    v-if="state.errors.email"
                    >{{ state.errors.email[0] }}</span
                >
                <input
                    v-model="state.credentials.password"
                    id="password"
                    name="password"
                    type="password"
                    autocomplete="current-password"
                    class="p-4 focus:outline-none focus:border-blue-400 border w-full rounded-lg my-1"
                    placeholder="Password"
                />
                <span
                    class="text-red-700 font-bold"
                    v-if="state.errors.password"
                    >{{ state.errors.password[0] }}</span
                >
                <span
                    class="text-red-700 font-bold"
                    v-if="state.errors.credentials"
                    >{{ state.errors.credentials[0] }}</span
                >
                <button
                    @click.prevent="login"
                    class="bg-white border rounded-xl font-bold text-black my-2 py-4 hover:text-white hover:bg-blue-400 transform transition duration-200 hover:scale-110 focus:outline-none"
                >
                    Login
                </button>
            </div>
            <router-link to="/" class="my-8 text-center hover:text-gray-400">
                Forgot your password?
            </router-link>
            <h2 class="my-8 text-center">
                Don't have an account yet?
                <router-link to="/register" class="hover:text-gray-400"
                    >Register</router-link
                >
            </h2>
        </div>
    </div>
</template>

<script>
import { reactive } from "vue";
import store from "../store";
import { useRouter } from "vue-router";

export default {
    setup() {
        const router = useRouter();

        const state = reactive({
            credentials: {
                email: "",
                password: "",
            },
            errors: [],
        });

        let login = () => {
            store.commit("toggleLoading", true);
            store
                .dispatch("login", { credentials: state.credentials })
                .then((response) => {
                    router.push({ path: "/" });
                    store.commit("toggleLoading", false);
                })
                .catch((error) => {
                    if (error.response.status === 422) {
                        state.errors = error.response.data.errors;
                        store.commit("toggleLoading", false);
                    }
                });
        };

        return { state, login };
    },
};
</script>

<style></style>
