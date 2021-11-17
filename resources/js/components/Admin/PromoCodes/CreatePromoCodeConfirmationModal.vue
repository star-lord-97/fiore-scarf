<template>
    <div
        class="fixed top-0 left-0 z-30 w-screen h-screen cursor-pointer bg-black bg-opacity-50"
        @click.prevent="$emit('closeModal')"
    ></div>
    <div class="fixed w-2/5 h-3/5 z-40 bg-white rounded-lg" id="modal-window">
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
            class="flex flex-col items-center justify-center h-full space-y-8 font-bold"
        >
            <div class="flex flex-col space-y-1 w-full">
                <div class="flex items-center justify-evenly">
                    <label for="promocode">Promocode:</label>
                    <input
                        type="text"
                        class="focus:outline-none border border-black focus:border-blue-400 rounded-lg py-1 px-2"
                        placeholder="Promocode"
                        name="promocode"
                        id="promocode"
                        v-model="state.promocode"
                        required
                    />
                </div>
                <span class="text-red-500 text-center" v-if="errors.code">{{
                    errors.code[0]
                }}</span>
            </div>
            <div class="flex items-center justify-evenly w-full">
                <label for="expiresAfter">Expires after (usages):</label>
                <input
                    type="text"
                    class="focus:outline-none border border-black focus:border-blue-400 rounded-lg py-1 px-2"
                    placeholder="Expires after (usages)"
                    name="expiresAfter"
                    id="expiresAfter"
                    v-model="state.expiresAfter"
                    required
                />
            </div>
            <div class="flex items-center justify-evenly w-full">
                <label for="type">Type:</label>
                <select
                    v-model="state.type"
                    name="type"
                    id="type"
                    class="focus:outline-none border border-black focus:border-blue-400 rounded-lg py-1 px-2"
                >
                    <option value="fixed" selected>Fixed price</option>
                    <option value="percent">Percentage discount</option>
                </select>
            </div>
            <div
                class="flex items-center justify-evenly w-full"
                v-show="state.type == 'fixed'"
            >
                <label for="value">Value(E£):</label>
                <input
                    type="text"
                    class="focus:outline-none border border-black focus:border-blue-400 rounded-lg py-1 px-2"
                    placeholder="Value"
                    name="value"
                    id="value"
                    v-model="state.value"
                    required
                />
            </div>
            <div
                class="flex items-center justify-evenly w-full"
                v-show="state.type == 'percent'"
            >
                <label for="percentage">Percentage(%): </label>
                <input
                    type="text"
                    class="focus:outline-none border border-black focus:border-blue-400 rounded-lg py-1 px-2"
                    placeholder="Percentage"
                    name="percentage"
                    id="percentage"
                    v-model="state.percentage"
                    required
                />
            </div>
            <button
                class="focus:outline-none bg-green-500 px-8 py-2 rounded-lg text-white transform transition duration-200 hover:scale-105 font-bold"
                v-show="state.value > 0 || state.percentage > 0"
                @click.prevent="
                    $emit('addPromocode', {
                        code: state.promocode,
                        type: state.type,
                        value: state.value,
                        percent_off: state.percentage,
                        expires_after: state.expiresAfter,
                    })
                "
            >
                Add promocode
            </button>
        </div>
    </div>
</template>

<script>
import { reactive } from "vue";

export default {
    props: ["errors"],
    emits: ["closeModal", "addPromocode"],

    setup() {
        const state = reactive({
            promocode: "",
            type: "",
            value: null,
            percentage: null,
            expiresAfter: "",
        });

        return { state };
    },
};
</script>

<style scoped>
#modal-window {
    top: 20%;
    left: 30%;
}
</style>
