<template>
    <div class="flex flex-col text-sm space-y-4 border-r-2">
        <router-link to="/admin/dashboard" class="hover:text-gray-400">
            Dashboard
        </router-link>
        <router-link to="/admin/homevideo" class="hover:text-gray-400">
            Home Video
        </router-link>
        <router-link to="/admin/users" class="hover:text-gray-400">
            Users
        </router-link>
        <router-link to="/admin/admins" class="hover:text-gray-400">
            Admins
        </router-link>
        <router-link to="/admin/orders" class="hover:text-gray-400">
            Orders
        </router-link>
        <router-link to="/admin/products" class="hover:text-gray-400">
            Products
        </router-link>
        <router-link to="/admin/promocodes" class="hover:text-gray-400">
            Promo Codes
        </router-link>
    </div>
</template>

<script>
export default {};
</script>

<style scoped>
.router-link-exact-active {
    font-weight: bold;
}
</style>
