<template>
    <div
        class="flex flex-col justify-center items-center space-y-4"
        v-if="state.users.length > 0"
    >
        <ExportUsersButton />
        <UsersTable :users="state.users" />
    </div>
    <div v-else class="text-center">No users in the database yet.</div>
</template>

<script>
import { onMounted, reactive } from "vue";
import ExportUsersButton from "../Users/ExportUsersButton";
import UsersTable from "../Users/UsersTable";
import store from "../../../store";

export default {
    components: {
        ExportUsersButton,
        UsersTable,
    },

    setup() {
        const state = reactive({
            users: [],
        });

        onMounted(() => {
            store.commit("toggleLoading", true);
            store.dispatch("adminGetAllUsers").then((response) => {
                state.users = response.data;
                store.commit("toggleLoading", false);
            });
        });

        return { state };
    },
};
</script>

<style></style>
