<template>
    <div class="flex flex-col justify-center items-center space-y-4">
        <table
            class="border border-green-100 text-center table-fixed"
            v-if="state.orders.length > 0"
        >
            <thead>
                <tr>
                    <th class="border border-green-100 py-1">Id</th>
                    <th class="border border-green-100 py-1">User</th>
                    <th class="border border-green-100 py-1">Order items</th>
                    <th class="border border-green-100 py-1">Order date</th>
                    <th class="border border-green-100 py-1">Subtotal</th>
                    <th class="border border-green-100 py-1">Promocode used</th>
                    <th class="border border-green-100 py-1">Total</th>
                    <th class="border border-green-100 py-1">Notes</th>
                    <th class="border border-green-100 py-1">Shipping date</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="order in state.orders" :key="order.id">
                    <td class="border border-green-100 px-8 py-2">
                        {{ order.id }}
                    </td>
                    <td class="border border-green-100 px-8 py-2">
                        <svg
                            viewBox="0 0 24 24"
                            class="w-6 h-6 fill-current text-green-200"
                            @click="
                                state.showUserDetailsModal = true;
                                state.userToShow = order.user;
                            "
                        >
                            <path d="M0 0h24v24H0V0z" fill="none" />
                            <path
                                d="M11 7h2v2h-2zm0 4h2v6h-2zm1-9C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"
                            />
                        </svg>
                    </td>
                    <td class="border border-green-100 px-8 py-2">
                        <svg
                            viewBox="0 0 24 24"
                            class="w-6 h-6 fill-current text-green-200"
                            @click="
                                state.showOrderItemsModal = true;
                                state.itemsToShow = order.items;
                            "
                        >
                            <path d="M0 0h24v24H0V0z" fill="none" />
                            <path
                                d="M11 7h2v2h-2zm0 4h2v6h-2zm1-9C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"
                            />
                        </svg>
                    </td>
                    <td class="border border-green-100 px-8 py-2">
                        {{ new Date(order.created_at).toDateString() }}
                    </td>
                    <td class="border border-green-100 px-8 py-2">
                        E£{{ order.subtotal }}
                    </td>
                    <td class="border border-green-100 px-8 py-2">
                        {{
                            order.promocode_used ? order.promocode_used : "---"
                        }}
                    </td>
                    <td class="border border-green-100 px-8 py-2">
                        E£{{ order.total }}
                    </td>
                    <td class="border border-green-100 px-8 py-2">
                        {{ order.notes ? order.notes : "---" }}
                    </td>
                    <td class="border border-green-100 px-8 py-2">
                        <span
                            v-if="
                                order.is_shipped === 1 ||
                                order.is_shipped === '1'
                            "
                        >
                            {{ order.shipping_date }}
                        </span>
                        <div class="flex flex-col space-y-2" v-else>
                            <span>Not yet shipped!</span>
                            <button
                                class="
                                    focus:outline-none
                                    bg-green-500
                                    px-4
                                    py-1
                                    rounded-lg
                                    text-white
                                    transform
                                    transition
                                    duration-200
                                    hover:scale-105
                                "
                                @click="updateShipment(order.id)"
                            >
                                Shipped already?!
                            </button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        <div v-else>No orders in the database yet.</div>
    </div>
    <UserDetailsModal
        v-if="state.showUserDetailsModal"
        :user="state.userToShow"
        @closeModal="state.showUserDetailsModal = false"
    />
    <OrderItemsModal
        v-if="state.showOrderItemsModal"
        :items="state.itemsToShow"
        @closeModal="state.showOrderItemsModal = false"
    />
</template>

<script>
import { onMounted, reactive } from "vue";
import store from "../../store";
import UserDetailsModal from "./Orders/UserDetailsModal.vue";
import OrderItemsModal from "./Orders/OrderItemsModal.vue";

export default {
    components: { UserDetailsModal, OrderItemsModal },
    setup() {
        const state = reactive({
            orders: [],
            showUserDetailsModal: false,
            userToShow: {},
            showOrderItemsModal: false,
            itemsToShow: {},
        });

        onMounted(() => {
            store.commit("toggleLoading", true);
            store.dispatch("adminGetAllOrders").then((response) => {
                state.orders = response.data;
                store.commit("toggleLoading", false);
            });
        });

        let updateShipment = (orderId) => {
            store.commit("toggleLoading", true);
            store
                .dispatch("adminUpdateOrderShipment", { id: orderId })
                .then((response) => {
                    state.orders = response.data;
                    store.commit("toggleLoading", false);
                });
        };

        return { state, updateShipment };
    },
};
</script>

<style></style>
