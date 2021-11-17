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
    <div class="fixed w-2/5 h-4/5 z-40 bg-white rounded-lg" id="modal-window">
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
        <div
            class="
                flex flex-col
                items-center
                justify-center
                space-y-4
                font-bold
                h-full
            "
        >
            <h1 class="border-2 rounded-lg py-1 px-4">Order items</h1>
            <div
                v-for="item in items"
                :key="item.id"
                class="border rounded-lg p-4"
            >
                <div class="flex justify-center items-center space-x-2">
                    <span>Product code:</span>
                    <span>{{ item.product.code }}</span>
                </div>
                <div class="flex justify-center items-center space-x-2">
                    <span>Product name:</span>
                    <span>{{ item.product.name }}</span>
                </div>
                <!-- <div class="flex justify-center items-center space-x-2">
                    <span>Size:</span>
                    <span>{{ item.size }}</span>
                </div> -->
                <div class="flex justify-center items-center space-x-2">
                    <span>Quantity:</span>
                    <span>{{ item.quantity }}</span>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ["items"],
    emits: ["closeModal"],
};
</script>

<style scoped>
#modal-window {
    top: 10%;
    left: 30%;
}
</style>
