<template>
    <div class="md:w-2/3 space-y-8" v-if="cartProducts.length > 0">
        <div class="flex justify-between border-b pb-8">
            <h1 class="font-semibold text-2xl">Shopping Cart</h1>
            <h2 class="font-semibold text-2xl">{{ quantity }} Item(s)</h2>
        </div>
        <div class="hidden md:flex">
            <h3 class="text-gray-500 text-sm uppercase w-2/6 text-center">
                Product Details
            </h3>
            <!-- <h3 class="text-gray-500 text-sm uppercase w-1/6 text-center">
                Size
            </h3> -->
            <h3 class="text-gray-500 text-sm uppercase w-1/6 text-center">
                Quantity
            </h3>
            <h3 class="text-gray-500 text-sm uppercase w-1/6 text-center">
                Total
            </h3>
            <h3 class="text-gray-500 text-sm uppercase w-1/6 text-center">
                Remove
            </h3>
        </div>
        <div v-for="product in cartProducts" :key="product.code">
            <CartItem :product="product" />
        </div>
    </div>
</template>

<script>
import CartItem from "./CartItem.vue";

export default {
    components: { CartItem },
    props: ["cartProducts"],
    computed: {
        quantity() {
            let totalAmount = 0;
            this.cartProducts.forEach((el) => {
                totalAmount += el.quantity;
            });
            return totalAmount;
        },
    },
};
</script>

<style></style>
