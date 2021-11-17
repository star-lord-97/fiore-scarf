<template>
    <div
        class="
            fixed
            top-0
            left-0
            z-30
            w-screen
            h-screen
            cursor-pointer
            bg-black bg-opacity-50
        "
        @click.prevent="$emit('closeModal')"
    ></div>
    <div class="fixed w-2/5 h-2/5 z-40 bg-white rounded-lg" id="modal-window">
        <svg
            class="
                w-6
                h-6
                fill-current
                absolute
                top-4
                right-4
                cursor-pointer
                transform
                transition
                duration-200
                hover:scale-125
            "
            @click.prevent="$emit('closeModal')"
            viewBox="0 0 24 24"
        >
            <path d="M0 0h24v24H0V0z" fill="none" />
            <path
                d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12 19 6.41z"
            />
        </svg>
        <div class="h-full flex flex-col justify-center items-center space-y-4">
            <h1 class="text-green-500">Welcome to FIORE-SCARF.com</h1>
            <router-link class="underline hover:no-underline" to="/login"
                >Login to start shopping</router-link
            >
        </div>
    </div>
</template>

<script>
export default {
    emits: ["closeModal"],
};
</script>

<style scoped>
#modal-window {
    top: 30%;
    left: 30%;
}
</style>
