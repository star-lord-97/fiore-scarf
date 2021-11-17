<template>
    <div class="w-full">
        <div class="px-4">
            <div
                class="container mx-auto flex flex-col space-y-8 my-8 text-sm divide-y-2"
            >
                <div class="space-y-8">
                    <h1 class="font-bold">Update your personal information</h1>
                    <Updateuser />
                </div>
                <!-- <div class="pt-8">
                    <h1 class="font-bold">Track your orders</h1>
                </div> -->
            </div>
        </div>
    </div>
</template>

<script>
import SideNav from "../components/User/SideNav";
import Updateuser from "../components/User/Updateuser";
import { computed } from "vue";
import { useRoute } from "vue-router";

export default {
    components: {
        SideNav,
        Updateuser,
    },
    setup() {
        const route = useRoute();

        const currentComponent = computed(() => {
            return (
                route.params.page.charAt(0).toUpperCase() +
                route.params.page.slice(1)
            );
        });

        return { currentComponent };
    },
};
</script>
