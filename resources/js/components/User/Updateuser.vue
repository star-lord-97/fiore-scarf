<template>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 border-2 p-4 rounded-lg">
        <div class="flex flex-col items-center space-y-1">
            <div class="flex justify-center items-center space-x-4">
                <label for="name">Name:</label>
                <input
                    type="text"
                    name="name"
                    id="name"
                    class="px-4 py-2 border border-black bg-white rounded-xl focus:outline-none focus:border-blue-400 text-sm"
                    v-model="state.userInfo.name"
                />
            </div>
            <span class="text-red-700 font-bold" v-if="state.errors.name">{{
                state.errors.name[0]
            }}</span>
        </div>
        <div class="flex flex-col items-center space-y-1">
            <div class="flex justify-center items-center space-x-4">
                <label for="phone">Phone:</label>
                <input
                    type="text"
                    name="phone"
                    id="phone"
                    class="px-4 py-2 border border-black bg-white rounded-xl focus:outline-none focus:border-blue-400 text-sm"
                    v-model="state.userInfo.phone"
                />
            </div>
            <span class="text-red-700 font-bold" v-if="state.errors.phone">{{
                state.errors.phone[0]
            }}</span>
        </div>
        <div class="flex flex-col items-center space-y-1">
            <div class="flex justify-center items-center space-x-4">
                <label for="address">Address:</label>
                <input
                    type="text"
                    name="address"
                    id="address"
                    class="px-4 py-2 border border-black bg-white rounded-xl focus:outline-none focus:border-blue-400 text-sm"
                    v-model="state.userInfo.address"
                />
            </div>
            <span class="text-red-700 font-bold" v-if="state.errors.address">{{
                state.errors.address[0]
            }}</span>
        </div>
        <div class="flex flex-col items-center space-y-1">
            <div class="flex justify-center items-center space-x-4">
                <label for="city">City:</label>
                <input
                    type="text"
                    name="city"
                    id="city"
                    class="px-4 py-2 border border-black bg-white rounded-xl focus:outline-none focus:border-blue-400 text-sm"
                    v-model="state.userInfo.city"
                />
            </div>
            <span class="text-red-700 font-bold" v-if="state.errors.city">{{
                state.errors.city[0]
            }}</span>
        </div>
    </div>
    <div class="flex justify-center items-center space-x-4">
        <button
            class="focus:outline-none transform transition duration-200 hover:scale-125 flex border py-2 px-8 rounded-lg bg-green-400 text-white font-bold"
            @click="updateUser"
        >
            Update
        </button>
        <h1 class="text-green-500" v-if="state.showUpdatedMessage">Updated</h1>
    </div>
</template>

<script>
import { onMounted, reactive } from "vue";
import store from "../../store";
export default {
    setup() {
        const state = reactive({
            userInfo: {},
            errors: [],
            showUpdatedMessage: false,
        });

        onMounted(() => {
            store.commit("toggleLoading", true);
            store.dispatch("getUserData").then((response) => {
                state.userInfo = response.data;
                store.commit("toggleLoading", false);
            });
        });

        let updateUser = () => {
            store.commit("toggleLoading", true);
            store
                .dispatch("updateUser", {
                    userInfo: state.userInfo,
                })
                .then((response) => {
                    state.userInfo = response.data;
                    state.errors = [];
                    store.commit("toggleLoading", false);
                    state.showUpdatedMessage = true;
                    setTimeout(() => {
                        state.showUpdatedMessage = false;
                    }, 1000);
                })
                .catch((error) => {
                    if (error.response.status === 422) {
                        state.errors = error.response.data.errors;
                        store.commit("toggleLoading", false);
                    }
                });
        };

        return { state, updateUser };
    },
};
</script>

<style></style>
