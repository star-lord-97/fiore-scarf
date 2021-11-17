<template>
    <div class="flex flex-col justify-center items-center space-y-4">
        <div>
            <div class="flex justify-center items-center space-x-4">
                <h1>
                    Want a user to become an admin?, make him create a regular
                    account and type his email here:
                </h1>
                <input
                    type="email"
                    class="focus:outline-none border border-black focus:border-blue-400 rounded-lg py-1 px-2"
                    placeholder="Email"
                    v-model="state.userEmailToMakeAdmin"
                    required
                />
                <button
                    class="focus:outline-none px-2 py-1.5 bg-green-500 rounded-lg text-white transform transition duration-200 hover:scale-105"
                    @click="state.showMakeAdminConfirmationModal = true"
                >
                    Make admin
                </button>
            </div>
            <div
                v-show="state.noUserWithThisEmail"
                class="flex justify-center items-center text-center text-red-500 font-bold"
            >
                No existing user with this email!!
            </div>
        </div>
        <table
            class="border border-green-100 text-center table-fixed"
            v-if="state.admins.length > 0"
        >
            <thead>
                <tr>
                    <th class="border border-green-100 py-1">Id</th>
                    <th class="border border-green-100 py-1">Name</th>
                    <th class="border border-green-100 py-1">Email</th>
                    <th class="border border-green-100 py-1">Phone number</th>
                    <th class="border border-green-100 py-1">Address</th>
                    <th class="border border-green-100 py-1">City</th>
                    <th class="border border-green-100 py-1">Remove</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="user in state.admins" :key="user.id">
                    <td class="border border-green-100 px-8 py-2">
                        {{ user.id }}
                    </td>
                    <td class="border border-green-100 px-8 py-2">
                        {{ user.name }}
                    </td>
                    <td class="border border-green-100 px-8 py-2">
                        {{ user.email }}
                    </td>
                    <td class="border border-green-100 px-8 py-2">
                        {{ user.phone }}
                    </td>
                    <td class="border border-green-100 px-8 py-2">
                        {{ user.address }}
                    </td>
                    <td class="border border-green-100 px-8 py-2">
                        {{ user.city }}
                    </td>
                    <td class="border border-green-100 px-8 py-2">
                        <button
                            class="focus:outline-none transform transition duration-200 hover:scale-125"
                            @click="
                                state.showRemoveAdminConfirmationModal = true;
                                state.adminIdToRemove = user.id;
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
        <div v-else>No admins in the database (but you) yet.</div>
    </div>
    <RemoveAdminConfirmationModal
        v-if="state.showRemoveAdminConfirmationModal"
        @closeModal="state.showRemoveAdminConfirmationModal = false"
        @removeAdmin="removeAdmin"
    />
    <MakeAdminConfirmationModal
        v-if="state.showMakeAdminConfirmationModal"
        @closeModal="state.showMakeAdminConfirmationModal = false"
        @makeAdmin="makeAdmin"
    />
</template>

<script>
import { onMounted, reactive } from "vue";
import store from "../../store";
import RemoveAdminConfirmationModal from "./Admins/RemoveAdminConfirmationModal.vue";
import MakeAdminConfirmationModal from "./Admins/MakeAdminConfirmationModal.vue";

export default {
    components: { RemoveAdminConfirmationModal, MakeAdminConfirmationModal },

    setup() {
        const state = reactive({
            admins: [],
            showRemoveAdminConfirmationModal: false,
            showMakeAdminConfirmationModal: false,
            adminIdToRemove: 0,
            noUserWithThisEmail: false,
            userEmailToMakeAdmin: "",
        });

        onMounted(() => {
            store.commit("toggleLoading", true);
            store.dispatch("adminGetAllAdmins").then((response) => {
                state.admins = response.data;
                store.commit("toggleLoading", false);
            });
        });

        let removeAdmin = () => {
            store.commit("toggleLoading", true);
            store
                .dispatch("adminRemoveAdmins", { id: state.adminIdToRemove })
                .then((response) => {
                    state.admins = response.data;
                    state.showRemoveAdminConfirmationModal = false;
                    store.commit("toggleLoading", false);
                });
        };

        let makeAdmin = () => {
            store.commit("toggleLoading", true);
            store
                .dispatch("adminMakeAdmins", {
                    email: state.userEmailToMakeAdmin,
                })
                .then((response) => {
                    state.admins = response.data;
                    state.noUserWithThisEmail = false;
                    state.showMakeAdminConfirmationModal = false;
                    state.userEmailToMakeAdmin = "";
                    store.commit("toggleLoading", false);
                })
                .catch((error) => {
                    if (
                        error.response.status === 404 ||
                        error.response.status === 405
                    ) {
                        state.showMakeAdminConfirmationModal = false;
                        state.userEmailToMakeAdmin = "";
                        state.noUserWithThisEmail = true;
                        store.commit("toggleLoading", false);
                    }
                });
        };

        return { state, removeAdmin, makeAdmin };
    },
};
</script>

<style></style>
