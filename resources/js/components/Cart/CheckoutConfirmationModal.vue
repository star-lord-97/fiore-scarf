<template>
    <div
        class="fixed top-0 left-0 z-30 w-screen h-screen cursor-pointer bg-black bg-opacity-50"
        @click.prevent="$emit('closeModal')"
    ></div>
    <div
        class="fixed w-4/5 h-full md:w-2/5 md:h-4/5 z-40 bg-white rounded-lg"
        id="modal-window"
    >
        <svg
            class="w-6 h-6 fill-current absolute top-4 right-4 cursor-pointer transform transition duration-200 hover:scale-125"
            @click.prevent="$emit('closeModal')"
            viewBox="0 0 24 24"
        >
            <path d="M0 0h24v24H0V0z" fill="none" />
            <path
                d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12 19 6.41z"
            />
        </svg>
        <div
            class="flex flex-col items-center justify-center text-center h-full space-y-4 text-sm"
        >
            <h1 class="font-bold text-xl border-b-2">Receipt</h1>
            <h1 class="font-bold">
                Subtotal:
                <span class="inline font-normal"
                    >{{ Number(subTotal).toFixed(2) }} EGP</span
                >
            </h1>
            <h1 class="font-bold">
                Promocode used:
                <span class="inline font-normal">{{
                    promoCode ? promoCode : "None used"
                }}</span>
            </h1>
            <h1 class="font-bold" v-show="promoCode">
                Promocode discount:
                <span class="inline font-normal">{{ discount }} EGP</span>
            </h1>
            <h1 class="font-bold">
                Shipping cost:
                <span class="inline font-normal">
                    {{ Number(45).toFixed(2) }}
                </span>
            </h1>
            <h1 class="font-bold">
                Total:
                <span class="inline font-normal">
                    {{ Number(total).toFixed(2) }}
                    EGP
                </span>
            </h1>
            <textarea
                name="notes"
                id="notes"
                cols="30"
                rows="2"
                placeholder="Notes"
                class="border border-black focus:border-blue-400 focus:outline-none rounded-lg p-2 relative"
                v-model="state.notes"
            ></textarea>
            <button
                class="bg-indigo-500 font-semibold hover:bg-indigo-600 py-3 px-6 text-sm text-white uppercase focus:outline-none"
                @click="$emit('confirmCheckout', { notes: state.notes })"
            >
                Confirm checkout
            </button>
        </div>
    </div>
</template>

<script>
import { reactive } from "vue";
export default {
    props: ["subTotal", "total", "promoCode", "discount", "method"],
    emits: ["closeModal", "confirmCheckout"],

    setup() {
        const state = reactive({
            notes: "",
        });

        return { state };
    },
};
</script>

<style scoped>
#modal-window {
    top: 10%;
    left: 10%;
}

@media (min-width: 768px) {
    #modal-window {
        top: 10%;
        left: 30%;
    }
}
</style>
