<template>
    <div class="fixed z-20 top-0 w-full">
        <NotificationBar />
        <NavigationBar
            :isLoggedIn="isLoggedIn"
            :isAdmin="isAdmin"
            @logout="$emit('logout')"
        />
    </div>
</template>

<script>
import store from "../../store";
import { computed } from "vue";
import NotificationBar from "./NotificationBar.vue";
import NavigationBar from "./NavigationBar.vue";

export default {
    components: {
        NotificationBar,
        NavigationBar,
    },

    emits: ["logout"],

    setup() {
        const isLoggedIn = computed(() => {
            return store.getters.isLoggedIn;
        });

        const isAdmin = computed(() => {
            return store.getters.isAdmin;
        });

        return { isLoggedIn, isAdmin };
    },
};
</script>

<style></style>
