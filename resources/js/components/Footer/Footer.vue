<template>
    <div class="absolute bottom-0 w-full">
        <div class="text-white px-4 py-1" style="background-color: #6d8e97">
            <div
                class="
                    container
                    mx-auto
                    grid grid-cols-2
                    gap-y-8
                    md:gap-0 md:grid-cols-4
                    py-8
                    font-thin
                "
            >
                <FooterCopyright />
                <FooterCategories
                    :categories="state.categories"
                    :showOnSaleCategory="state.showOnSaleCategory"
                />
                <FooterContact />
                <!-- <SubscribeToNewsletter
                    @showSubscriptionModal="handleSubscription"
                /> -->
            </div>
        </div>
    </div>
    <!-- <SubscriptionModal
        v-if="state.showSubscriptionModal"
        :status="state.subscriptionStatus"
        @closeModal="state.showSubscriptionModal = false"
    ></SubscriptionModal> -->
</template>

<script>
import { onMounted, reactive } from "vue";
import store from "../../store";
// import SubscriptionModal from "./SubscriptionModal.vue";
import FooterCopyright from "./FooterCopyright.vue";
import FooterCategories from "./FooterCategories.vue";
import FooterContact from "./FooterContact.vue";
// import SubscribeToNewsletter from "./SubscribeToNewsletter.vue";

export default {
    components: {
        // SubscriptionModal,
        FooterCopyright,
        FooterCategories,
        FooterContact,
        // SubscribeToNewsletter,
    },
    setup() {
        const state = reactive({
            categories: [],
            showOnSaleCategory: false,
            // showSubscriptionModal: false,
            // subscriptionStatus: "",
        });

        onMounted(() => {
            store.commit("toggleLoading", true);
            store.dispatch("getAllCategories").then((response) => {
                state.showOnSaleCategory = response.data.show_on_sale_category;
                state.categories = response.data.categories;
                store.commit("toggleLoading", false);
            });
        });

        // let handleSubscription = (payload) => {
        //     state.subscriptionStatus = payload.status;
        //     state.showSubscriptionModal = true;
        // };

        return { state /*handleSubscription*/ };
    },
};
</script>

<style scoped>
.router-link-exact-active {
    font-weight: bold;
}
</style>
