<template>
    <div class="flex flex-col justify-center items-center space-y-4">
        <h1>Upload the home video:</h1>
        <input
            id="hero"
            name="hero"
            type="file"
            @change="state.formData.append('hero', $event.target.files[0])"
        />
        <span class="text-red-500 text-xs" v-if="state.errors.video">{{
            state.errors.video[0]
        }}</span>
        <button
            class="focus:outline-none bg-green-500 px-8 py-2 rounded-lg text-white transform transition duration-200 hover:scale-105"
            @click="addVideo"
        >
            Add video
        </button>
    </div>
</template>

<script>
import { reactive } from "vue";
import store from "../../store";
import { useRouter } from "vue-router";

export default {
    setup() {
        const router = useRouter();

        const state = reactive({
            formData: new FormData(),
            errors: [],
        });

        let addVideo = () => {
            store.commit("toggleLoading", true);
            store
                .dispatch("adminChangeHomeVideo", state.formData)
                .then((response) => {
                    router.push("/");
                })
                .catch((error) => {
                    if (error.response.status === 422) {
                        state.errors = error.response.data.errors;
                        store.commit("toggleLoading", false);
                    }
                });
        };

        return { state, addVideo };
    },
};
</script>

<style></style>
