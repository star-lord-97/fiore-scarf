<template>
    <router-link
        to="/"
        class="hover:text-gray-400"
        @click.prevent="$emit('closeMobileMenu')"
        >Home</router-link
    >
    <router-link
        to="/shop"
        class="hover:text-gray-400"
        @click.prevent="$emit('closeMobileMenu')"
        >Shop</router-link
    >
    <div
        class="relative md:hidden"
        @click="state.servicesDropdownMenu = !state.servicesDropdownMenu"
    >
        <div
            class="hover:cursor-pointer hover:opacity-75 flex items-center space-x-1"
        >
            <span>Categories</span>
            <svg viewBox="0 0 24 24" class="inline fill-current h-6 w-6">
                <path d="M0 0h24v24H0V0z" fill="none" />
                <path d="M7 10l5 5 5-5H7z" />
            </svg>
        </div>
        <transition name="servicesDropdown">
            <div
                v-show="state.servicesDropdownMenu"
                class="md:absolute flex flex-col items-start md:items-center justify-between space-y-4 mt-4 ml-4 md:ml-0 md:bg-white md:py-4 md:rounded-b-2xl z-10"
            >
                <router-link to="/shop" class="hover:text-gray-400"
                    >New In Store</router-link
                >
                <router-link
                    to="/shop/On Sale"
                    class="hover:text-gray-400"
                    v-show="state.showOnSaleCategory"
                    >On Sale</router-link
                >
                <router-link
                    v-for="category in state.categories"
                    :key="category.id"
                    :to="'/shop/' + category"
                    class="hover:text-gray-400"
                    @click.prevent="$emit('closeMobileMenu')"
                    >{{ category }}</router-link
                >
            </div>
        </transition>
    </div>
    <router-link
        to="/about"
        class="hover:text-gray-400"
        @click.prevent="$emit('closeMobileMenu')"
        >About us</router-link
    >
    <router-link
        to="/contact"
        class="hover:text-gray-400"
        @click.prevent="$emit('closeMobileMenu')"
        >Contact us</router-link
    >
</template>

<script>
import { onMounted, reactive } from "vue";
import store from "../../store";

export default {
    emits: ["closeMobileMenu"],

    setup() {
        const state = reactive({
            servicesDropdownMenu: false,
            categories: [],
            showOnSaleCategory: false,
        });

        onMounted(() => {
            store.commit("toggleLoading", true);
            store.dispatch("getAllCategories").then((response) => {
                state.showOnSaleCategory = response.data.show_on_sale_category;
                state.categories = response.data.categories;
                store.commit("toggleLoading", false);
            });
        });

        return { state };
    },
};
</script>

<style scoped>
.router-link-active {
    font-weight: bold;
}

.servicesDropdown-enter-from,
.servicesDropdown-leave-to {
    transform: translateY(-20px);
    opacity: 0;
}
.servicesDropdown-enter-active,
.servicesDropdown-leave-active {
    transition: all 0.3s ease-out;
}
</style>
