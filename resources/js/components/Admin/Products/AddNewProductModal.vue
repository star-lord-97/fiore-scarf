<template>
    <div
        class="
            fixed
            top-0
            left-0
            z-30
            w-screen
            h-screen
            cursor-pointer
            bg-black bg-opacity-50
        "
        @click.prevent="$emit('closeModal')"
    ></div>
    <div class="fixed w-5/6 h-5/6 z-40 bg-white rounded-lg" id="modal-window">
        <svg
            class="
                w-6
                h-6
                fill-current
                absolute
                top-4
                right-4
                cursor-pointer
                transform
                transition
                duration-200
                hover:scale-125
            "
            @click.prevent="$emit('closeModal')"
            viewBox="0 0 24 24"
        >
            <path d="M0 0h24v24H0V0z" fill="none" />
            <path
                d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12 19 6.41z"
            />
        </svg>
        <div class="grid grid-cols-2 m-8 font-bold space-x-8">
            <div class="flex flex-col space-y-8">
                <div class="flex items-center space-x-4 w-4/5">
                    <label for="code">Code: </label>
                    <input
                        type="text"
                        class="
                            focus:outline-none
                            border border-black
                            focus:border-blue-400
                            rounded-lg
                            py-1
                            px-2
                            w-full
                        "
                        :class="
                            errors.code && state.code.length <= 0
                                ? 'border-red-500'
                                : ''
                        "
                        :placeholder="errors.code ? errors.code[0] : 'Code'"
                        name="code"
                        id="code"
                        v-model="state.code"
                    />
                </div>
                <div class="flex items-center space-x-4 w-4/5">
                    <label for="name">Name: </label>
                    <input
                        type="text"
                        class="
                            focus:outline-none
                            border border-black
                            focus:border-blue-400
                            rounded-lg
                            py-1
                            px-2
                            w-full
                        "
                        :class="
                            errors.name && state.name.length <= 0
                                ? 'border-red-500'
                                : ''
                        "
                        :placeholder="errors.name ? errors.name[0] : 'Name'"
                        name="name"
                        id="name"
                        v-model="state.name"
                    />
                </div>
                <div class="flex items-center space-x-4 w-4/5">
                    <label for="details">Details: </label>
                    <textarea
                        name="details"
                        id="details"
                        rows="5"
                        class="
                            focus:outline-none
                            border border-black
                            focus:border-blue-400
                            rounded-lg
                            py-1
                            px-2
                            w-full
                        "
                        :class="
                            errors.details && state.details.length <= 0
                                ? 'border-red-500'
                                : ''
                        "
                        :placeholder="
                            errors.details ? errors.details[0] : 'Details'
                        "
                        v-model="state.details"
                    ></textarea>
                </div>
                <!-- v-show="!state.showAddCategoryField" -->
                <div class="flex items-center space-x-4 w-4/5">
                    <label for="category">Category: </label>
                    <select
                        name="category"
                        id="category"
                        class="
                            focus:outline-none
                            border border-black
                            focus:border-blue-400
                            rounded-lg
                            py-0.5
                            px-2
                            w-full
                        "
                        :class="
                            errors.category && state.category.length <= 0
                                ? 'border-red-500'
                                : ''
                        "
                        v-model="state.category"
                    >
                        <option value="Chiffon">Chiffon</option>
                        <option value="Satin">Satin</option>
                        <option value="Square Satin">Square Satin</option>
                        <option value="Linen">Linen</option>
                    </select>
                    <!-- <button
                        class="whitespace-nowrap bg-green-300 px-2 py-1 rounded-lg focus:outline-none"
                        @click="state.showAddCategoryField = true"
                    >
                        Add new
                    </button> -->
                </div>
                <!-- <div
                    class="flex items-center space-x-4 w-4/5"
                    v-show="state.showAddCategoryField"
                >
                    <label class="whitespace-nowrap" for="category"
                        >New category:
                    </label>
                    <input
                        type="text"
                        class="focus:outline-none border border-black focus:border-blue-400 rounded-lg py-1 px-2 w-full"
                        :class="
                            errors.category && state.category.length <= 0
                                ? 'border-red-500'
                                : ''
                        "
                        name="category"
                        id="category"
                        v-model="state.category"
                    />
                </div> -->
                <div class="flex items-center space-x-4 w-4/5">
                    <label for="sale">Sale: </label>
                    <select
                        name="sale"
                        id="sale"
                        class="
                            focus:outline-none
                            border border-black
                            focus:border-blue-400
                            rounded-lg
                            py-0.5
                            px-2
                            w-full
                        "
                        v-model="state.sale"
                    >
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                    </select>
                </div>
                <div class="flex items-center space-x-4 w-4/5">
                    <label for="price">Price: </label>
                    <input
                        type="text"
                        class="
                            focus:outline-none
                            border border-black
                            focus:border-blue-400
                            rounded-lg
                            py-1
                            px-2
                            w-full
                        "
                        :class="
                            errors.price && state.price.length <= 0
                                ? 'border-red-500'
                                : ''
                        "
                        :placeholder="errors.price ? errors.price[0] : 'Price'"
                        name="price"
                        id="price"
                        v-model="state.price"
                    />
                </div>
            </div>
            <div class="flex flex-col space-y-8">
                <div class="space-y-4 w-4/5 border-2 rounded-lg p-4">
                    <h1>Stock:</h1>
                    <div class="flex items-center space-x-4">
                        <!-- <label for="name">Size</label>
                        <input
                            type="text"
                            name="name"
                            class="
                                focus:outline-none
                                border border-black
                                focus:border-blue-300
                                w-32
                                rounded-lg
                                py-1
                                px-2
                            "
                            v-model="state.sizes[0].size"
                        /> -->
                        <label for="units">Units</label>
                        <input
                            type="number"
                            name="units"
                            class="
                                focus:outline-none
                                border border-black
                                focus:border-blue-300
                                w-16
                                rounded-lg
                                py-1
                                px-2
                            "
                            v-model="state.sizes[0].units"
                        />
                    </div>
                    <!-- <div class="flex items-center space-x-4">
                        <label for="name">Size</label>
                        <input
                            type="text"
                            name="name"
                            class="
                                focus:outline-none
                                border border-black
                                focus:border-blue-300
                                w-32
                                rounded-lg
                                py-1
                                px-2
                            "
                            v-model="state.sizes[1].size"
                        />
                        <label for="units">Units</label>
                        <input
                            type="number"
                            name="units"
                            class="
                                focus:outline-none
                                border border-black
                                focus:border-blue-300
                                w-16
                                rounded-lg
                                py-1
                                px-2
                            "
                            v-model="state.sizes[1].units"
                        />
                    </div> -->
                    <!-- <div class="flex items-center space-x-4">
                        <label for="name">Size</label>
                        <input
                            type="text"
                            name="name"
                            class="
                                focus:outline-none
                                border border-black
                                focus:border-blue-300
                                w-32
                                rounded-lg
                                py-1
                                px-2
                            "
                            v-model="state.sizes[2].size"
                        />
                        <label for="units">Units</label>
                        <input
                            type="number"
                            name="units"
                            class="
                                focus:outline-none
                                border border-black
                                focus:border-blue-300
                                w-16
                                rounded-lg
                                py-1
                                px-2
                            "
                            v-model="state.sizes[2].units"
                        />
                    </div> -->
                </div>
                <div class="space-y-4 w-4/5">
                    <div
                        class="
                            flex flex-col
                            justify-center
                            space-y-4
                            border-2
                            rounded-lg
                            p-4
                        "
                    >
                        <label for="images"
                            >Images(hold Ctrl to select multiple):
                        </label>
                        <input
                            id="images"
                            name="images"
                            type="file"
                            @change="handleFileChange"
                            multiple
                        />
                    </div>
                    <span
                        class="text-red-500 text-xs"
                        v-if="errors['images.0']"
                        >{{ errors["images.0"][0] }}</span
                    >
                    <span
                        class="text-red-500 text-xs"
                        v-else-if="errors.images"
                        >{{ errors.images[0] }}</span
                    >
                </div>
                <button
                    class="
                        focus:outline-none
                        bg-green-500
                        px-8
                        py-2
                        rounded-lg
                        text-white
                        transform
                        transition
                        duration-200
                        hover:scale-105
                        w-4/5
                    "
                    @click.prevent="handleAddProduct"
                >
                    Add product
                </button>
            </div>
        </div>
    </div>
</template>

<script>
import { reactive } from "vue";

export default {
    props: ["errors"],
    emits: ["closeModal", "addProduct"],

    setup(props, { emit }) {
        const state = reactive({
            code: "",
            name: "",
            details: "",
            category: "",
            sale: 0,
            price: "",
            sizes: [{ size: "medium", units: null }],
            formData: new FormData(),
            // showAddCategoryField: false,
        });

        let handleFileChange = (event) => {
            let files = event.target.files;

            for (let i = 0; i < files.length; i++) {
                let file = files[i];
                state.formData.append("images[" + i + "]", file);
            }
        };

        let handleAddProduct = () => {
            state.formData.append("name", state.name);
            state.formData.append("code", state.code);
            state.formData.append("details", state.details);
            state.formData.append("category", state.category);
            state.formData.append("sale", state.sale);
            state.formData.append("price", state.price);
            for (let i = 0; i < state.sizes.length; i++) {
                let size = state.sizes[i];
                state.formData.append("sizes[" + i + "]", size.size);
                state.formData.append("units[" + i + "]", size.units);
            }
            emit("addProduct", state.formData);
        };

        return { state, handleFileChange, handleAddProduct };
    },
};
</script>

<style scoped>
#modal-window {
    top: 8%;
    left: 8%;
}
</style>
