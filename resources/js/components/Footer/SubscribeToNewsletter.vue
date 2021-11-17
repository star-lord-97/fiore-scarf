<template>
    <div class="flex flex-col space-y-4 col-span-2 md:col-span-1">
        <h1 class="font-normal text-center">Subscribe to our newsletter</h1>
        <div class="flex flex-col space-y-1">
            <input
                type="email"
                placeholder="Write Your Email"
                class="p-4 border border-white bg-black rounded-xl focus:outline-none focus:border-blue-400 text-sm"
                v-model="state.email"
            />
            <span
                class="text-red-700 font-bold ml-4 md:inline block text-sm"
                v-if="state.errors.email"
                >{{ state.errors.email[0] }}</span
            >
        </div>
        <button
            class="bg-white rounded-xl font-bold text-black py-4 hover:text-white hover:bg-blue-400 transform transition duration-200 hover:scale-110 focus:outline-none"
            @click.prevent="subscribeToNewsletter"
        >
            Subscribe
        </button>
    </div>
</template>

<script>
import { reactive } from "vue";
import store from "../../store";

export default {
    emits: ["showSubscriptionModal"],

    setup(props, { emit }) {
        const state = reactive({
            email: "",
            subscriptionStatus: "",
            errors: [],
        });

        let subscribeToNewsletter = () => {
            store.commit("toggleLoading", true);
            store
                .dispatch("subscribeToNewsletter", {
                    email: state.email,
                })
                .then((response) => {
                    state.subscriptionStatus = response.data;
                    state.email = "";
                    state.errors = [];
                    emit("showSubscriptionModal", {
                        status: state.subscriptionStatus,
                    });
                    store.commit("toggleLoading", false);
                })
                .catch((error) => {
                    if (error.response.status === 422) {
                        state.errors = error.response.data.errors;
                        store.commit("toggleLoading", false);
                    }
                });
        };

        return { state, subscribeToNewsletter };
    },
};
</script>

<style></style>
