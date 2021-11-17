<template>
    <div class="flex flex-col justify-center items-center space-y-4">
        <button
            class="
                focus:outline-none
                bg-green-500
                px-4
                py-1
                rounded-lg
                text-white
                transform
                transition
                duration-200
                hover:scale-105
            "
            @click="state.showCreatePromoCodeConfirmationModal = true"
        >
            Add promocode
        </button>
        <table
            class="border border-green-100 text-center table-fixed"
            v-if="state.promocodes.length > 0"
        >
            <thead>
                <tr>
                    <th class="border border-green-100 py-1">Code</th>
                    <th class="border border-green-100 py-1">Type</th>
                    <th class="border border-green-100 py-1">Value</th>
                    <th class="border border-green-100 py-1">Percent off</th>
                    <th class="border border-green-100 py-1">Expires after</th>
                    <th class="border border-green-100 py-1">Used</th>
                    <th class="border border-green-100 py-1">Remaining</th>
                    <th class="border border-green-100 py-1">Remove</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="promocode in state.promocodes" :key="promocode.id">
                    <td class="border border-green-100 px-8 py-2">
                        {{ promocode.code }}
                    </td>
                    <td class="border border-green-100 px-8 py-2">
                        {{ promocode.type }}
                    </td>
                    <td class="border border-green-100 px-8 py-2">
                        <span v-if="promocode.type == 'fixed'"
                            >E£{{ Number(promocode.value).toFixed(2) }}</span
                        >
                        <span v-if="promocode.type == 'percent'">---</span>
                    </td>
                    <td class="border border-green-100 px-8 py-2">
                        <span v-if="promocode.type == 'percent'"
                            >{{
                                Number(promocode.percent_off).toFixed(2)
                            }}%</span
                        >
                        <span v-else>---</span>
                    </td>
                    <td class="border border-green-100 px-8 py-2">
                        {{ promocode.expires_after }} usages
                    </td>
                    <td class="border border-green-100 px-8 py-2">
                        {{ promocode.used_times }} time(s)
                    </td>
                    <td class="border border-green-100 px-8 py-2">
                        {{ promocode.expires_after - promocode.used_times }}
                        usages
                    </td>
                    <td class="border border-green-100 px-8 py-2">
                        <button
                            class="
                                focus:outline-none
                                transform
                                transition
                                duration-200
                                hover:scale-125
                            "
                            @click="
                                state.showRemovePromoCodeConfirmationModal = true;
                                state.promocodeToRemove = promocode.code;
                            "
                        >
                            <svg
                                viewBox="0 0 24 24"
                                class="fill-current text-red-500 h-6 w-6"
                            >
                                <path d="M0 0h24v24H0z" fill="none" />
                                <path
                                    d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4z"
                                />
                            </svg>
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
        <div v-else>No promocodes in the database yet.</div>
    </div>
    <CreatePromoCodeConfirmationModal
        v-if="state.showCreatePromoCodeConfirmationModal"
        :errors="state.errors"
        @closeModal="state.showCreatePromoCodeConfirmationModal = false"
        @addPromocode="addPromocode"
    />
    <RemovePromoCodeConfirmationModal
        v-if="state.showRemovePromoCodeConfirmationModal"
        @closeModal="state.showRemovePromoCodeConfirmationModal = false"
        @removePromocode="removePromocode"
    />
</template>

<script>
import { onMounted, reactive } from "vue";
import CreatePromoCodeConfirmationModal from "./PromoCodes/CreatePromoCodeConfirmationModal";
import RemovePromoCodeConfirmationModal from "./PromoCodes/RemovePromoCodeConfirmationModal";
import store from "../../store";

export default {
    components: {
        CreatePromoCodeConfirmationModal,
        RemovePromoCodeConfirmationModal,
    },

    setup() {
        const state = reactive({
            promocodes: [],
            showCreatePromoCodeConfirmationModal: false,
            showRemovePromoCodeConfirmationModal: false,
            promocodeToRemove: "",
            errors: [],
        });

        onMounted(() => {
            store.commit("toggleLoading", true);
            store.dispatch("adminGetAllPromoCodes").then((response) => {
                state.promocodes = response.data;
                store.commit("toggleLoading", false);
            });
        });

        let addPromocode = (payload) => {
            state.errors = [];
            store.commit("toggleLoading", true);
            store
                .dispatch("adminAddNewPromoCode", payload)
                .then((response) => {
                    state.promocodes = response.data;
                    state.showCreatePromoCodeConfirmationModal = false;
                    store.commit("toggleLoading", false);
                })
                .catch((error) => {
                    if (error.response.status === 422) {
                        state.errors = error.response.data.errors;
                        store.commit("toggleLoading", false);
                    }
                });
        };

        let removePromocode = () => {
            store.commit("toggleLoading", true);
            state.showRemovePromoCodeConfirmationModal = false;
            store
                .dispatch("adminRemovePromoCode", {
                    code: state.promocodeToRemove,
                })
                .then((response) => {
                    state.promocodes = response.data;
                    store.commit("toggleLoading", false);
                });
        };

        return { state, addPromocode, removePromocode };
    },
};
</script>

<style></style>
