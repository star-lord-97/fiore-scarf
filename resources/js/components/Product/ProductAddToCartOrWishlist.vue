<template>
    <div class="flex flex-col my-8 space-y-8">
        <!-- <div>
            <label class="mr-4">Size: </label>
            <select
                v-model="state.order.size"
                class="focus:outline-none border py-0.5"
            >
                <option disabled value="">Availabe sizes</option>
                <option v-for="size in sizes" :key="size.id" :value="size.size">
                    {{ size.size }}
                </option>
            </select>
        </div> -->
        <div v-if="state.order.size.length > 0">
            <label class="mr-4">Quantity: </label>
            <button
                @click="
                    state.order.quantity > 1 ? state.order.quantity-- : null
                "
                class="focus:outline-none"
            >
                <svg
                    class="fill-current text-gray-600 w-3"
                    viewBox="0 0 448 512"
                >
                    <path
                        d="M416 208H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h384c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z"
                    />
                </svg>
            </button>
            <input
                class="mx-2 border text-center w-8"
                type="text"
                v-model="state.order.quantity"
            />
            <button
                @click="
                    state.order.quantity <
                    sizes[
                        sizes.findIndex((size) => size.size == state.order.size)
                    ].units
                        ? state.order.quantity++
                        : null
                "
                class="focus:outline-none"
            >
                <svg
                    class="fill-current text-gray-600 w-3"
                    viewBox="0 0 448 512"
                >
                    <path
                        d="M416 208H272V64c0-17.67-14.33-32-32-32h-32c-17.67 0-32 14.33-32 32v144H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h144v144c0 17.67 14.33 32 32 32h32c17.67 0 32-14.33 32-32V304h144c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z"
                    />
                </svg>
            </button>
        </div>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-16 gap-y-4">
        <button
            @click="
                $emit('addToCart', {
                    quantity: state.order.quantity,
                    size:
                        state.order.size.length > 1
                            ? state.order.size
                            : sizes[0].size,
                })
            "
            class="
                border-2 border-black
                text-xl
                py-2
                hover:bg-black hover:text-white
                rounded-lg
                transition
                duration-200
                focus:outline-none
                md:col-start-1 md:row-start-1 md:w-full
                w-2/3
                mx-auto
                md:mx-0
                disabled:cursor-not-allowed disabled:opacity-25
            "
            v-if="sizes"
            :disabled="sizes.length <= 0"
        >
            Add to Cart
        </button>
        <button
            @click="$emit('addToWishlist')"
            class="
                border-2 border-black
                text-xl
                py-2
                hover:bg-black hover:text-white
                rounded-lg
                transition
                duration-200
                focus:outline-none
                md:col-start-2 md:row-start-1 md:w-full
                w-2/3
                mx-auto
                md:mx-0
            "
        >
            Add to Wishlist
        </button>
    </div>
</template>

<script>
import { reactive } from "vue";

export default {
    props: ["sizes"],
    emits: ["addToWishlist", "addToCart"],

    setup() {
        const state = reactive({
            order: {
                quantity: 1,
                size: "",
            },
        });

        return { state };
    },
};
</script>

<style></style>
