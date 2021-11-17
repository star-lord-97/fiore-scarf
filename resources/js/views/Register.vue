<template>
    <div class="w-full">
        <div
            class="container mx-auto flex flex-col items-center justify-center my-8"
        >
            <h2 class="my-8 text-center text-3xl font-bold">
                Create a new account
            </h2>
            <div class="w-4/5 md:w-1/3 flex flex-col">
                <input
                    v-model="state.credentials.name"
                    id="name"
                    name="name"
                    type="text"
                    class="p-4 focus:outline-none focus:border-blue-400 border w-full rounded-lg my-1"
                    placeholder="Name"
                />
                <span class="text-red-700 font-bold" v-if="state.errors.name">{{
                    state.errors.name[0]
                }}</span>
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
                    v-model="state.credentials.phone"
                    id="phone-number"
                    name="phone-number"
                    type="text"
                    class="p-4 focus:outline-none focus:border-blue-400 border w-full rounded-lg my-1"
                    placeholder="Phone Number"
                />
                <span
                    class="text-red-700 font-bold"
                    v-if="state.errors.phone"
                    >{{ state.errors.phone[0] }}</span
                >
                <input
                    v-model="state.credentials.address"
                    id="address"
                    name="address"
                    type="text"
                    class="p-4 focus:outline-none focus:border-blue-400 border w-full rounded-lg my-1"
                    placeholder="Delivery Address"
                />
                <span
                    class="text-red-700 font-bold"
                    v-if="state.errors.address"
                    >{{ state.errors.address[0] }}</span
                >
                <input
                    v-model="state.credentials.city"
                    id="city"
                    name="city"
                    type="text"
                    class="p-4 focus:outline-none focus:border-blue-400 border w-full rounded-lg my-1"
                    placeholder="City"
                />
                <span class="text-red-700 font-bold" v-if="state.errors.city">{{
                    state.errors.city[0]
                }}</span>
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
                <input
                    v-model="state.credentials.password_confirmation"
                    id="password_confirmation"
                    name="password_confirmation"
                    type="password"
                    autocomplete="current-password"
                    class="p-4 focus:outline-none focus:border-blue-400 border w-full rounded-lg my-1"
                    placeholder="Password Confirmation"
                />
                <button
                    @click.prevent="register"
                    class="bg-white border rounded-xl font-bold text-black my-2 py-4 hover:text-white hover:bg-blue-400 transform transition duration-200 hover:scale-110 focus:outline-none"
                >
                    Register
                </button>
            </div>
            <h2 class="my-8 text-center">
                Already have an account?
                <router-link to="/login" class="hover:text-gray-400"
                    >Login</router-link
                >
            </h2>
        </div>
        <WelcomeModal
            v-if="state.showWelcomeModal"
            @closeModal="state.showWelcomeModal = false"
        />
    </div>
</template>

<script>
import { reactive } from "vue";
import store from "../store";
import WelcomeModal from "../components/Home/WelcomeModal.vue";

export default {
    components: { WelcomeModal },
    setup() {
        const state = reactive({
            showWelcomeModal: false,

            credentials: {
                name: "",
                email: "",
                phone: "",
                address: "",
                city: "",
                password: "",
                password_confirmation: "",
            },

            errors: [],
        });

        let register = () => {
            store.commit("toggleLoading", true);
            store
                .dispatch("register", { credentials: state.credentials })
                .then((response) => {
                    store.commit("toggleLoading", false);
                    state.showWelcomeModal = true;
                })
                .catch((error) => {
                    if (error.response.status === 422) {
                        store.commit("toggleLoading", false);
                        state.errors = error.response.data.errors;
                    }
                });
        };

        return { state, register };
    },
};
</script>
