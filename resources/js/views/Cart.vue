<template>
    <div class="w-full">
        <div class="px-4">
            <div
                v-if="cartProducts.length > 0"
                class="
                    container
                    mx-auto
                    my-8
                    flex flex-col
                    space-y-8
                    md:flex-row md:space-x-8
                    justify-between
                "
            >
                <ShoppingCart :cartProducts="cartProducts" />
                <div class="md:w-1/4" v-if="cartProducts.length > 0">
                    <h1
                        class="
                            font-semibold
                            text-2xl
                            border-b
                            pb-8
                            mt-0
                            md:border-t-0
                            border-t
                            pt-8
                            md:pt-0
                        "
                    >
                        Order Summary
                    </h1>
                    <div class="flex justify-between mt-10 mb-5 mx-1 md:mx-0">
                        <span class="font-semibold text-sm uppercase"
                            >Item(s) {{ quantity }}</span
                        >
                        <span class="font-semibold text-sm"
                            >E£{{ Number(subTotal).toFixed(2) }}</span
                        >
                    </div>
                    <div class="py-8 mx-1 md:mx-0">
                        <label
                            for="promo"
                            class="
                                font-semibold
                                inline-block
                                mb-3
                                text-sm
                                uppercase
                            "
                            >Promo Code</label
                        >
                        <input
                            type="text"
                            id="promo"
                            placeholder="Enter your code"
                            class="
                                p-2
                                text-sm
                                w-full
                                focus:outline-none
                                border
                                focus:border-blue-500
                                mb-2
                            "
                            v-model="state.promoCode"
                        />
                        <span
                            class="text-red-700 font-bold"
                            v-if="
                                state.errors.promoCode || state.errors.expired
                            "
                            >{{
                                state.errors.promoCode
                                    ? state.errors.promoCode[0]
                                    : state.errors.expired[0]
                            }}</span
                        >
                    </div>
                    <button
                        v-show="!state.showRemovePromoCodeButton"
                        class="
                            bg-red-500
                            hover:bg-red-600
                            px-5
                            py-2
                            text-sm text-white
                            uppercase
                            ml-1
                            md:ml-0
                            focus:outline-none
                            disabled:opacity-50 disabled:cursor-not-allowed
                        "
                        @click="applyPromoCode"
                    >
                        Apply
                    </button>
                    <button
                        v-show="state.showRemovePromoCodeButton"
                        class="
                            bg-red-500
                            hover:bg-red-600
                            px-5
                            py-2
                            text-sm text-white
                            uppercase
                            ml-1
                            md:ml-0
                            focus:outline-none
                            disabled:opacity-50 disabled:cursor-not-allowed
                        "
                        @click="removePromoCode"
                    >
                        Remove
                    </button>
                    <div class="border-t mt-8 mx-1 md:mx-0">
                        <div
                            class="
                                flex
                                font-semibold
                                justify-between
                                py-6
                                text-sm
                                uppercase
                            "
                        >
                            <span>Discount</span>
                            <span
                                >-E£{{
                                    Number(subTotal - state.total).toFixed(2)
                                }}</span
                            >
                        </div>
                        <!-- <div
                            v-if="quantity >= 2"
                            class="
                                flex
                                font-semibold
                                justify-between
                                py-6
                                text-sm
                                uppercase
                            "
                        >
                            <span>But 2 get 1 for free offer</span>
                            <span
                                >-E£{{
                                    Number(cartProducts[0].price).toFixed(2)
                                }}</span
                            >
                        </div> -->
                        <div
                            class="
                                flex
                                font-semibold
                                justify-between
                                py-6
                                text-sm
                                uppercase
                            "
                        >
                            <span>Payment method</span>
                            <select
                                class="focus:outline-none border py-1 px-4"
                                v-model="state.paymentMethod"
                            >
                                <option value="cashOnDelivery">
                                    Cash on delivery
                                </option>
                            </select>
                        </div>
                        <div
                            class="
                                flex
                                font-semibold
                                justify-between
                                py-6
                                text-sm
                                uppercase
                            "
                        >
                            <span>Shipping cost</span>
                            <span>E£{{ Number(45).toFixed(2) }}</span>
                        </div>
                        <div
                            class="
                                flex
                                font-semibold
                                justify-between
                                py-6
                                text-sm
                                uppercase
                            "
                        >
                            <span>Total cost</span>
                            <span
                                >E£{{
                                    Number(totalWithShipping).toFixed(2)
                                }}</span
                            >
                        </div>
                        <button
                            class="
                                bg-indigo-500
                                font-semibold
                                hover:bg-indigo-600
                                py-3
                                text-sm text-white
                                uppercase
                                w-full
                                focus:outline-none
                            "
                            @click="state.showCheckoutConfirmationModal = true"
                        >
                            Checkout
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <EmptyCart v-if="cartProducts.length == 0" />
        <CheckoutConfirmationModal
            v-if="state.showCheckoutConfirmationModal"
            @closeModal="state.showCheckoutConfirmationModal = false"
            @confirmCheckout="confirmCheckout"
            :subTotal="subTotal"
            :total="totalWithShipping"
            :promoCode="state.promoCode"
            :discount="subTotal - state.total"
            :method="state.paymentMethod"
        />
        <OrderThanksModal
            v-if="state.showOrderThanksModal"
            @closeModal="state.showOrderThanksModal = false"
        />
    </div>
</template>

<script>
import store from "../store";
import { computed, reactive } from "vue";
import EmptyCart from "../components/Cart/EmptyCart.vue";
import CheckoutConfirmationModal from "../components/Cart/CheckoutConfirmationModal.vue";
import ShoppingCart from "../components/Cart/ShoppingCart.vue";
import OrderThanksModal from "../components/Cart/OrderThanksModal.vue";

export default {
    components: {
        EmptyCart,
        CheckoutConfirmationModal,
        ShoppingCart,
        OrderThanksModal,
    },

    setup() {
        const state = reactive({
            promoCode: "",
            errors: [],
            total: subTotal,
            showRemovePromoCodeButton: false,
            showCheckoutConfirmationModal: false,
            showOrderThanksModal: false,
            paymentMethod: "cashOnDelivery",
        });

        const cartProducts = computed(() => {
            return store.getters.cart;
        });

        const subTotal = computed(() => {
            let subTotal = 0;

            for (let index = 0; index < cartProducts.value.length; index++) {
                subTotal =
                    subTotal +
                    cartProducts.value[index].price *
                        cartProducts.value[index].quantity;
            }

            state.total = subTotal;

            return subTotal;
        });

        const quantity = computed(() => {
            let totalAmount = 0;
            for (let index = 0; index < cartProducts.value.length; index++) {
                totalAmount += cartProducts.value[index].quantity;
            }
            return totalAmount;
        });

        const totalWithShipping = computed(() => {
            // if (quantity.value >= 2)
            //     return state.total + 45 - cartProducts.value[0].price;
            // else
            return state.total + 45;
        });

        let applyPromoCode = () => {
            if (state.promoCode.length <= 0) {
                state.errors = {
                    promoCode: ["Please enter a valid promo code."],
                };
            } else {
                state.errors = [];
                store.commit("toggleLoading", true);
                store
                    .dispatch("getPromoCodeDiscount", {
                        promoCode: state.promoCode,
                        subTotal: subTotal.value,
                    })
                    .then((response) => {
                        state.total = response.data;
                        state.showRemovePromoCodeButton = true;
                        store.commit("toggleLoading", false);
                    })
                    .catch((error) => {
                        if (error.response.status === 404) {
                            state.errors = {
                                promoCode: ["Please enter a valid promo code."],
                            };
                            state.promoCode = "";
                        } else if (error.response.status === 422) {
                            state.errors = error.response.data.errors;
                            state.promoCode = "";
                        }
                        store.commit("toggleLoading", false);
                    });
            }
        };

        let removePromoCode = () => {
            store.commit("toggleLoading", true);
            state.total = subTotal.value;
            state.showRemovePromoCodeButton = false;
            state.promoCode = "";
            store.commit("toggleLoading", false);
        };

        let confirmCheckout = (payload) => {
            store.commit("toggleLoading", true);
            store
                .dispatch("checkout", {
                    subTotal: subTotal.value,
                    promoCode: state.promoCode,
                    total: totalWithShipping.value,
                    products: cartProducts.value,
                    notes: payload.notes,
                })
                .then((response) => {
                    state.showCheckoutConfirmationModal = false;
                    store.commit("emptyCart");
                    state.showOrderThanksModal = true;
                    store.commit("toggleLoading", false);
                });
        };

        return {
            state,
            subTotal,
            totalWithShipping,
            cartProducts,
            applyPromoCode,
            confirmCheckout,
            removePromoCode,
            quantity,
        };
    },
};
</script>

<style></style>
