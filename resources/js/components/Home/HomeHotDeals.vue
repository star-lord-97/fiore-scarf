<template>
    <div
        class="grid grid-cols-2 grid-rows-3 md:grid-cols-3 md:grid-rows-2 gap-4 h-96 md:h-80 px-4"
    >
        <router-link
            to="/shop/On Sale"
            class="h-full w-full relative col-span-2 md:col-span-1 md:row-span-2"
        >
            <img
                class="h-full w-full object-contain object-center rounded-xl"
                src="/img/categories/sale.jpg"
                alt=""
            />
        </router-link>
        <router-link
            to="/shop/Chiffon"
            class="h-full w-full relative row-span-1"
        >
            <img
                class="h-full w-full object-cover object-center rounded-xl"
                src="/img/categories/chiffon.jpg"
                alt=""
            />
        </router-link>
        <router-link to="/shop/Linen" class="h-full w-full relative row-span-1">
            <img
                class="h-full w-full object-cover object-center rounded-xl"
                src="/img/categories/linen.jpg"
                alt=""
            />
        </router-link>
        <router-link to="/shop/Satin" class="h-full w-full relative row-span-1">
            <img
                class="h-full w-full object-cover object-center rounded-xl"
                src="/img/categories/satin.jpg"
                alt=""
            />
        </router-link>
        <router-link
            to="/shop/Square Satin"
            class="h-full w-full relative row-span-1"
        >
            <img
                class="h-full w-full object-cover object-center rounded-xl"
                src="/img/categories/square satin.jpg"
                alt=""
            />
        </router-link>
    </div>
</template>

<script>
export default {};
</script>

<style></style>
