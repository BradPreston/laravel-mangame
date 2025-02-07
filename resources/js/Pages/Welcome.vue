<script setup>
import { Head, usePage } from "@inertiajs/vue3";
import { computed } from "vue";
import Hero from "../Components/UI/Hero.vue";
import Container from "../Components/Layout/Container.vue";

const page = usePage();

const anime = computed(() => page.props.trendingAnime);
const manga = computed(() => page.props.trendingManga);
console.log(anime.value);
</script>

<template>
    <Head title="Welcome" />
    <Hero
        title="Welcome"
        body="Use Manganime to track your Anime and Manga progress"
        linkTitle="View catalog"
        linkHref="/"
        background="https://img.daisyui.com/images/stock/photo-1507358522600-9f71e620c44e.webp"
    />
    <Container>
        <section class="mt-16 flex flex-col justify-center">
            <h2>Trending Anime</h2>
            <ul class="list-none grid grid-cols-3 gap-4 p-0">
                <li v-for="a of anime.data">
                    <a :href="a.links.self">
                        <img
                            loading="lazy"
                            class="my-0"
                            :src="a.attributes.posterImage.small"
                        />
                        <h3 class="mt-0">{{ a.attributes.canonicalTitle }}</h3>
                    </a>
                </li>
            </ul>
            <a href="/" class="btn btn-primary mx-auto">See More Anime</a>
        </section>

        <section class="mt-16 flex flex-col justify-center">
            <h2>Trending Manga</h2>
            <ul class="list-none grid grid-cols-3 gap-4 p-0">
                <li v-for="m of manga.data">
                    <img
                        loading="lazy"
                        class="my-0"
                        :src="m.attributes.posterImage.small"
                    />
                    <h3 class="mt-0">{{ m.attributes.canonicalTitle }}</h3>
                </li>
            </ul>
            <a href="/" class="btn btn-primary mx-auto">See More Manga</a>
        </section>
    </Container>
</template>
