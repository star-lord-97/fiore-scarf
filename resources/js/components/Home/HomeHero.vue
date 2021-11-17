<template>
    <div class="relative" id="hero">
        <div class="w-full h-full bg-gray-900 opacity-50 z-10 absolute"></div>
        <div
            class="
                w-full
                h-full
                z-10
                absolute
                flex flex-col
                justify-center
                items-center
                text-center text-white
            "
        >
            <h1 class="text-5xl my-4 uppercase">New Collection</h1>
            <router-link
                to="/shop"
                class="
                    py-2
                    px-4
                    rounded-lg
                    hover:bg-white hover:text-black
                    my-4
                    transition
                    duration-200
                    uppercase
                "
                style="background-color: #6d8e97"
            >
                Order Now
            </router-link>
        </div>
        <!-- <video
            class="w-full h-full object-cover"
            autoplay="autoplay"
            muted="muted"
        >
            <source
                :src="'/vid/hero.' + $store.getters.heroExt"
                type="video/mp4"
            />
        </video> -->
        <img src="/img/hero.jpg" alt="" class="w-full h-full object-cover" />
    </div>
</template>

<script>
export default {};
</script>

<style scoped>
#hero {
    height: 500px;
}

@media (min-width: 768px) {
    #hero {
        height: 600px;
    }
}
</style>
