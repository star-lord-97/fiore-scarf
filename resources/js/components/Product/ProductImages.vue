<template>
    <Carousel class="mb-16 md:mb-0 mx-auto md:mx-0">
        <Slide v-for="image in images" :key="image.id">
            <img
                class="h-full w-full object-cover object-center"
                :src="image.image_path"
                alt=""
            />
        </Slide>
        <template #addons>
            <Navigation />
            <Pagination />
        </template>
    </Carousel>
</template>

<script>
import "vue3-carousel/dist/carousel.css";
import { Carousel, Slide, Pagination, Navigation } from "vue3-carousel";

export default {
    props: ["images"],

    components: {
        Carousel,
        Slide,
        Pagination,
        Navigation,
    },
};
</script>

<style>
.carousel,
.carousel__slide {
    width: 350px;
    height: 500px;
}

@media (min-width: 768px) {
    .carousel,
    .carousel__slide {
        width: 550px;
        height: 550px;
    }
}

button.carousel__prev:focus,
button.carousel__next:focus {
    outline: none;
}

button.carousel__prev,
button.carousel__next {
    background-color: #999;
}

button.carousel__pagination-button:focus {
    outline: none;
}

button.carousel__pagination-button {
    height: 12px;
    width: 12px;
    border-radius: 9999px;
    background-color: #ccc;
}

button.carousel__pagination-button.carousel__pagination-button--active {
    background-color: #999;
}
</style>
