<template>
    <div class="hidden md:block space-y-4">
        <h1 class="font-normal">Shop</h1>
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
.router-link-active {
    font-weight: bold;
}
</style>
