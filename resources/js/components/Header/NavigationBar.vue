<template>
    <div class="text-white px-4 py-3" style="background-color: #6d8e97">
        <div
            class="
                container
                mx-auto
                flex
                justify-between
                items-center
                font-thin
            "
        >
            <router-link to="/">
                <!-- <span class="text-4xl">FIORE-SCARF</span>
                <span>.com</span> -->
                <img src="/img/logo.png" alt="" width="88" height="40" />
            </router-link>
            <div class="hidden md:flex space-x-8">
                <NavigationBarLinks />
            </div>
            <div class="hidden md:flex items-center space-x-2">
                <NavigationBarIcons
                    :isLoggedIn="isLoggedIn"
                    :isAdmin="isAdmin"
                    @logout="$emit('logout')"
                />
            </div>
            <div class="flex items-center space-x-4 md:hidden">
                <router-link
                    @click.prevent="$emit('closeMobileMenu')"
                    to="/user/updateuser"
                >
                    <svg
                        class="w-6 h-6 fill-current"
                        viewBox="0 0 256 256"
                        v-show="isLoggedIn"
                    >
                        <rect width="256" height="256" fill="none"></rect>
                        <circle
                            cx="128"
                            cy="96"
                            r="64"
                            fill="none"
                            stroke="hsl(0, 0%, 100%)"
                            stroke-miterlimit="10"
                            stroke-width="16"
                        ></circle>
                        <path
                            d="M30.989,215.99064a112.03731,112.03731,0,0,1,194.02311.002"
                            fill="none"
                            stroke="hsl(0, 0%, 100%)"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="16"
                        ></path>
                    </svg>
                </router-link>
                <button
                    @click="state.openMobileMenu = !state.openMobileMenu"
                    class="focus:outline-none transition-all duration-300"
                >
                    <svg viewBox="0 0 24 24" class="fill-current h-6 w-6">
                        <path d="M0 0h24v24H0z" fill="none" />
                        <path
                            d="M3 18h18v-2H3v2zm0-5h18v-2H3v2zm0-7v2h18V6H3z"
                        />
                    </svg>
                </button>
            </div>
        </div>
        <transition name="mobileMenu">
            <div
                v-show="state.openMobileMenu"
                class="fixed w-3/4 h-screen z-20 text-white right-1/4"
                style="background-color: #6d8e97"
            >
                <div
                    class="
                        flex flex-col
                        items-start
                        justify-between
                        space-y-8
                        my-8
                        ml-8
                        font-thin
                        text-sm
                    "
                >
                    <NavigationBarLinks
                        @closeMobileMenu="state.openMobileMenu = false"
                    />
                    <div class="flex items-center space-x-2">
                        <NavigationBarIcons
                            :isLoggedIn="isLoggedIn"
                            :isAdmin="isAdmin"
                            @logout="$emit('logout')"
                            @closeMobileMenu="state.openMobileMenu = false"
                        />
                    </div>
                </div>
            </div>
        </transition>
    </div>
</template>

<script>
import NavigationBarLinks from "./NavigationBarLinks.vue";
import NavigationBarIcons from "./NavigationBarIcons";
import { reactive } from "vue";

export default {
    components: {
        NavigationBarLinks,
        NavigationBarIcons,
    },

    props: ["isLoggedIn", "isAdmin"],

    emits: ["logout"],

    setup() {
        const state = reactive({
            openMobileMenu: false,
        });

        return { state };
    },
};
</script>

<style scoped>
.mobileMenu-enter-from,
.mobileMenu-leave-to {
    transform: translateX(-20px);
    opacity: 0;
}

.mobileMenu-enter-active,
.mobileMenu-leave-active {
    transition: all 0.3s ease-out;
}
</style>
