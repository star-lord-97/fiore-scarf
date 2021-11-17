<template>
    <div class="hidden md:flex flex-col w-1/6">
        <h1 class="font-bold text-xl mb-8">Categories</h1>
        <div class="flex flex-col space-y-1">
            <router-link to="/shop" class="hover:text-gray-400"
                >New In Store</router-link
            >
            <router-link
                to="/shop/On Sale"
                class="hover:text-gray-400"
                v-show="showOnSaleCategory"
                >On Sale</router-link
            >
            <router-link
                class="hover:text-gray-400"
                v-for="category in categories"
                :key="category.id"
                :to="'/shop/' + category"
            >
                {{ category }}
            </router-link>
        </div>
    </div>
</template>

<script>
export default {
    props: ["categories", "showOnSaleCategory"],
};
</script>

<style scoped>
.router-link-exact-active {
    font-weight: bold;
}
</style>
