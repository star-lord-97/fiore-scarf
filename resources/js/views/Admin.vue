<template>
    <div class="w-full">
        <div class="px-4">
            <div
                class="container mx-auto hidden md:grid grid-cols-8 gap-4 space-y-8 my-8 text-sm"
            >
                <div class="col-span-1">
                    <SideNav />
                </div>
                <div class="col-span-7">
                    <component :is="currentComponent"></component>
                </div>
            </div>
            <div
                class="container flex flex-col space-y-8 my-8 items-center md:hidden"
            >
                <svg
                    viewBox="0 0 106.059 106.059"
                    class="w-16 h-16 fill-current"
                >
                    <path
                        d="M90.546,15.518C69.858-5.172,36.199-5.172,15.515,15.513C-5.173,36.198-5.171,69.858,15.517,90.547
		c20.682,20.684,54.341,20.684,75.027-0.004C111.23,69.858,111.229,36.2,90.546,15.518z M84.757,84.758
		c-17.494,17.494-45.96,17.496-63.455,0.002c-17.498-17.497-17.496-45.966,0-63.46C38.796,3.807,67.261,3.805,84.759,21.302
		C102.253,38.796,102.251,67.265,84.757,84.758z M77.017,74.001c0.658,1.521-0.042,3.286-1.562,3.943
		c-1.521,0.66-3.286-0.042-3.944-1.562c-2.893-6.689-9.73-11.012-17.421-11.012c-7.868,0-14.747,4.319-17.522,11.004
		c-0.479,1.154-1.596,1.851-2.771,1.851c-0.384,0-0.773-0.074-1.15-0.23c-1.53-0.636-2.255-2.392-1.62-3.921
		c3.71-8.932,12.764-14.703,23.063-14.703C64.174,59.371,73.174,65.113,77.017,74.001z M33.24,38.671
		c0-3.424,2.777-6.201,6.201-6.201c3.423,0,6.2,2.776,6.2,6.201c0,3.426-2.777,6.202-6.2,6.202
		C36.017,44.873,33.24,42.097,33.24,38.671z M61.357,38.671c0-3.424,2.779-6.201,6.203-6.201c3.423,0,6.2,2.776,6.2,6.201
		c0,3.426-2.776,6.202-6.2,6.202S61.357,42.097,61.357,38.671z"
                    />
                </svg>
                <h1 class="text-center font-bold text-red-500">
                    Admin panel is not available for mobiles, try a bigger
                    screen.
                </h1>
            </div>
        </div>
    </div>
</template>

<script>
import SideNav from "../components/Admin/SideNav";
// import Dashboard from "../components/Admin/Dashboard";
import Homevideo from "../components/Admin/Homevideo";
import Orders from "../components/Admin/Orders";
import Products from "../components/Admin/Products";
import Users from "../components/Admin/Users/Users";
import Admins from "../components/Admin/Admins";
import Promocodes from "../components/Admin/Promocodes";
import { computed } from "vue";
import { useRoute } from "vue-router";

export default {
    components: {
        SideNav,
        // Dashboard,
        Homevideo,
        Orders,
        Products,
        Users,
        Promocodes,
        Admins,
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
