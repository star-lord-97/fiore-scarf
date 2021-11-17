<template>
    <div
        class="
            flex flex-col
            md:flex-row
            items-center
            hover:bg-gray-100
            py-4
            border-b
        "
    >
        <div class="md:w-2/6 grid grid-cols-2 gap-16 md:gap-0 px-8">
            <div class="w-32 h-32 md:w-20 md:h-20">
                <a :href="'/product/' + product.code">
                    <img
                        class="
                            h-full
                            w-full
                            object-cover object-center
                            rounded-full
                        "
                        :src="product.image"
                        alt=""
                    />
                </a>
            </div>
            <div class="flex flex-col justify-between ml-4">
                <span class="font-bold text-base md:text-sm">
                    <a :href="'/product/' + product.code">
                        {{ product.name }}
                    </a>
                </span>
                <span class="text-gray-900 text-sm"
                    >Price: E£{{ Number(product.price).toFixed(2) }}</span
                >
                <span class="text-gray-500 text-sm"
                    >Code: {{ product.code }}</span
                >
            </div>
        </div>
        <!-- <select
            @change="updateSize($event, product.code)"
            class="hidden md:block w-1/6 focus:outline-none border py-0.5"
            :value="product.size"
        >
            <option
                v-for="size in product.sizes"
                :key="size.id"
                :value="size.size"
            >
                {{ size.size }}
            </option>
        </select> -->
        <div class="hidden md:flex justify-center w-1/6">
            <button
                @click="quantityMinusOne(product.code)"
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
                :value="product.quantity"
            />
            <button
                @click="quantityPlusOne(product.code)"
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
        <span class="hidden md:inline text-center w-1/6 font-semibold text-sm"
            >E£{{ productTotal(product.quantity, product.price) }}</span
        >
        <div class="md:hidden flex items-center w-full justify-evenly my-8">
            <!-- <select
                @change="updateSize($event, product.code)"
                class="focus:outline-none border py-0.5"
            >
                <option
                    v-for="size in product.sizes"
                    :key="size.id"
                    :value="size.size"
                >
                    {{ size.size }}
                </option>
            </select> -->
            <div class="flex justify-center">
                <button
                    @click="quantityMinusOne(product.code)"
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
                    :value="product.quantity"
                />
                <button
                    @click="quantityPlusOne(product.code)"
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
            <span class="text-center font-semibold text-sm"
                >E£{{ productTotal(product.quantity, product.price) }}</span
            >
        </div>
        <button
            class="
                md:w-1/6
                focus:outline-none
                transform
                transition
                duration-200
                hover:scale-125
            "
            @click="deleteFromCart(product.code)"
        >
            <svg
                xmlns="http://www.w3.org/2000/svg"
                height="24"
                viewBox="0 0 24 24"
                width="24"
                class="mx-auto fill-current text-red-500 hidden md:block"
            >
                <path d="M0 0h24v24H0z" fill="none" />
                <path
                    d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4z"
                />
            </svg>
            <span class="mx-auto fill-current text-red-500 font-bold md:hidden"
                >Delete</span
            >
        </button>
    </div>
</template>

<script>
import store from "../../store";

export default {
    props: ["product"],

    setup() {
        // let updateSize = (event, productCode) => {
        //     store.commit("updateCart", {
        //         code: productCode,
        //         size: event.target.value,
        //     });
        // };

        let quantityMinusOne = (productCode) => {
            store.commit("updateCart", {
                code: productCode,
                quantityMinusOne: true,
            });
        };

        let quantityPlusOne = (productCode) => {
            store.commit("updateCart", {
                code: productCode,
                quantityPlusOne: true,
            });
        };

        let deleteFromCart = (productCode) => {
            store.commit("deleteFromCart", {
                code: productCode,
            });
        };

        let productTotal = (quantity, price) => {
            return Number(quantity * price).toFixed(2);
        };

        return {
            // updateSize,
            quantityMinusOne,
            productTotal,
            quantityPlusOne,
            deleteFromCart,
        };
    },
};
</script>

<style></style>
