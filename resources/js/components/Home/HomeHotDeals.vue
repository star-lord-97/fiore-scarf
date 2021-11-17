<template>
    <div
        class="grid grid-cols-2 grid-rows-3 md:grid-cols-3 md:grid-rows-2 gap-4 h-96 md:h-80 px-4"
    >
        <router-link
            to="/shop/Blouses"
            class="h-full w-full relative col-span-2 md:col-span-1 md:row-span-2"
        >
            <div
                class="w-full h-full bg-gray-900 opacity-30 z-10 absolute rounded-xl"
            ></div>
            <div
                class="w-full h-full z-10 absolute flex flex-col justify-center items-center text-white transform transition duration-200 hover:scale-110 text-center"
            >
                <h1 class="text-2xl md:text-5xl border-b pb-1 md:pb-4">
                    Save 50%
                </h1>
                <h1 class="text-sm md:text-lg mt-1 md:mt-4">on Blouses</h1>
            </div>
            <img
                class="h-full w-full object-cover object-center rounded-xl"
                src="/img/hot-deals/l.jpg"
                alt=""
            />
        </router-link>
        <router-link
            to="/shop/Dresses"
            class="h-full w-full relative row-span-1"
        >
            <div
                class="w-full h-full bg-gray-900 opacity-30 z-10 absolute rounded-xl"
            ></div>
            <div
                class="w-full h-full z-10 absolute flex flex-col justify-center items-center text-white transform transition duration-200 hover:scale-110 text-center"
            >
                <h1 class="text-xl md:text-5xl border-b pb-1 md:pb-4">
                    Save 20%
                </h1>
                <h1 class="text-xs md:text-lg mt-1 md:mt-4">on Dresses</h1>
            </div>
            <img
                class="h-full w-full object-cover object-center rounded-xl"
                src="/img/hot-deals/m-t.jpg"
                alt=""
            />
        </router-link>
        <router-link
            to="/shop/On Sale"
            class="h-full w-full relative row-span-1"
        >
            <div
                class="w-full h-full bg-gray-900 opacity-30 z-10 absolute rounded-xl"
            ></div>
            <div
                class="w-full h-full z-10 absolute flex flex-col justify-center items-center text-white transform transition duration-200 hover:scale-110 text-center"
            >
                <h1 class="text-xl md:text-5xl border-b pb-1 md:pb-4">
                    Save 70%
                </h1>
                <h1 class="text-xs md:text-lg mt-1 md:mt-4">
                    on Selected Items
                </h1>
            </div>
            <img
                class="h-full w-full object-cover object-center rounded-xl"
                src="/img/hot-deals/m-b.jpg"
                alt=""
            />
        </router-link>
        <router-link
            to="/shop/Cardigans"
            class="h-full w-full relative row-span-1"
        >
            <div
                class="w-full h-full bg-gray-900 opacity-30 z-10 absolute rounded-xl"
            ></div>
            <div
                class="w-full h-full z-10 absolute flex flex-col justify-center items-center text-white transform transition duration-200 hover:scale-110 text-center"
            >
                <h1 class="text-xl md:text-5xl border-b pb-1 md:pb-4">
                    Save 30%
                </h1>
                <h1 class="text-xs md:text-lg mt-1 md:mt-4">on Cardigans</h1>
            </div>
            <img
                class="h-full w-full object-cover object-center rounded-xl"
                src="/img/hot-deals/r-t.jpg"
                alt=""
            />
        </router-link>
        <router-link to="/shop/Coats" class="h-full w-full relative row-span-1">
            <div
                class="w-full h-full bg-gray-900 opacity-30 z-10 absolute rounded-xl"
            ></div>
            <div
                class="w-full h-full z-10 absolute flex flex-col justify-center items-center text-white transform transition duration-200 hover:scale-110 text-center"
            >
                <h1 class="text-xl md:text-5xl border-b pb-1 md:pb-4">
                    Save 25%
                </h1>
                <h1 class="text-xs md:text-lg mt-1 md:mt-4">on Coats</h1>
            </div>
            <img
                class="h-full w-full object-cover object-center rounded-xl"
                src="/img/hot-deals/r-b.jpg"
                alt=""
            />
        </router-link>
    </div>
</template>

<script>
export default {};
</script>

<style></style>
